<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $user = User::factory()->create();
        $user->assignRole('customer');
        $user->customer()->create([
            'nama_lengkap'  => $faker->name(),
            'notelp'        => '+62887232132',
            'alamat'        => $faker->address(),
            'jk'            => 'p'
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $user = User::factory()->create();
        $user->assignRole('customer');
        $user->customer()->create([
            'nama_lengkap'  => $faker->name(),
            'notelp'        => '+62887232132',
            'alamat'        => $faker->address(),
            'jk'            => 'p'
        ]);
        $user->email_verified_at = null;
        $user->save();
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'nama' => 'Test User',
                'jk' => 'p',
                'alamat' => $faker->address(),
                'notelp'    => '+62887232132',
                'username' => 'TestUser',
                'email'     => 'test@gmail.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('TestUser', $user->name);
        $this->assertSame('test@gmail.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $user = User::factory()->create();
        $user->assignRole('customer');
        $user->customer()->create([
            'nama_lengkap'  => $faker->name(),
            'notelp'        => '+62887232132',
            'alamat'        => $faker->address(),
            'jk'            => 'p'
        ]);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'nama' => 'Test User',
                'jk' => 'p',
                'alamat' => $faker->address(),
                'notelp'    => '+62887232132',
                'username' => 'TestUser',
                'email'     => 'test@gmail.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');
        $faker = \Faker\Factory::create('id_ID');
        $user->customer()->create([
            'nama_lengkap'  => $faker->name(),
            'notelp'        => '+62887232132',
            'alamat'        => $faker->address(),
            'jk'            => 'p'
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertSoftDeleted($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');
        $faker = \Faker\Factory::create('id_ID');
        $user->customer()->create([
            'nama_lengkap'  => $faker->name(),
            'notelp'        => '+62887232132',
            'alamat'        => $faker->address(),
            'jk'            => 'p'
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
