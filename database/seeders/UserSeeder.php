<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'admin@kasirpintar.id',
            'password' => Hash::make('admin123'),
            'role' => Role::ADMIN,
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'kasir@kasirpintar.id',
            'password' => Hash::make('kasir123'),
            'role' => Role::CASHIER,
        ]);
    }
}
