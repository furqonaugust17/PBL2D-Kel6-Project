<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $karyawans = [
            [
                'nama' => 'Supervisor',
                'jk' => 'l',
                'notelp' => '081111111111',
                'alamat' => 'Jl. Supervisor No. 1',
                'jabatan' => 'supervisor',
                'username' => 'supervisor',
                'email' => 'supervisor@supervisor.monobi.com',
                'password' => 'password123',
            ],
            [
                'nama' => 'Administrasi',
                'jk' => 'l',
                'notelp' => '082222222222',
                'alamat' => 'Jl. Admin No. 2',
                'jabatan' => 'administrasi',
                'username' => 'administrasi',
                'email' => 'administrasi@administrasi.monobi.com',
                'password' => 'password123',
            ],
            [
                'nama' => 'Asisten',
                'jk' => 'p',
                'notelp' => '083333333333',
                'alamat' => 'Jl. Asisten No. 3',
                'jabatan' => 'asisten-studio',
                'username' => 'asisten-studio',
                'email' => 'asisten-studio@asisten-studio.monobi.com',
                'password' => 'password123',
            ],
            [
                'nama' => 'Teacher',
                'jk' => 'p',
                'notelp' => '084444444444',
                'alamat' => 'Jl. Teacher No. 4',
                'jabatan' => 'teacher',
                'username' => 'teacher',
                'email' => 'teacher@teacher.monobi.com',
                'password' => 'password123',
            ],
        ];

        foreach ($karyawans as $item) {
            $user = User::create([
                'name' => $item['username'],
                'email' => $item['email'],
                'password' => Hash::make($item['password']),
                'email_verified_at' => now()
            ]);

            $user->assignRole($item['jabatan']);

            Karyawan::create([
                'nama' => $item['nama'],
                'jk' => $item['jk'],
                'notelp' => $item['notelp'],
                'alamat' => $item['alamat'],
                'user_id' => $user->id,
            ]);
        }
    }
}
