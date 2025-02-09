<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicules')->insert([
            [
                'marque' => 'Toyota',
                'model' => 'Camry',
                'nom_proprietaire' => 'John Doe',
            ],
            [
                'marque' => 'Honda',
                'model' => 'Civic',
                'nom_proprietaire' => 'Jane Smith',
            ],
        ]);
    }
}