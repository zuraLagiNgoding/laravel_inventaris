<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('12345678'),
        ]);

        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@mail.com',
            'role' => 'OPERATOR',
            'password' => Hash::make('12345678'),
        ]);

        $petugas = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@mail.com',
            'role' => 'PETUGAS',
            'password' => Hash::make('12345678'),
        ]);
    }
}
