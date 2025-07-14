<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $data = [
            'username'  => $faker->userName(),
            'email'     => 'test@gmail.com',
            'password' => '!!!Test_123',
            'password_confirmation' => '!!!Test_123',
            'nama_lengkap'  => $faker->name(),
            'jk'    => 'p',
            'notelp'    => '+628312321312',
            'alamat'    => $faker->address()
        ];

        $response = $this->post('/register', $data);

        $user = \App\Models\User::where('email', $data['email'])->first();
        $user->markEmailAsVerified();

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
