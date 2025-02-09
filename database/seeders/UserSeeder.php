<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Use Hash::make for passwords
                'role' => 'admin',
            ],
            [
                'name' => 'Gestionnaire',
                'email' => 'gestionnaire@example.com',
                'password' => Hash::make('password'),
                'role' => 'gestionnaire',
            ],
            [
                'name' => 'Chauffeur',
                'email' => 'chauffeur@example.com',
                'password' => Hash::make('password'),
                'role' => 'chauffeur',
            ],
        ]);
    }
}