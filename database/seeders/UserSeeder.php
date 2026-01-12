<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@atk.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Staf Gudang User
        User::create([
            'name' => 'Staf Gudang',
            'email' => 'gudang@atk.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_STAF_GUDANG,
        ]);

        // Kasir User
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@atk.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_KASIR,
        ]);
    }
}
