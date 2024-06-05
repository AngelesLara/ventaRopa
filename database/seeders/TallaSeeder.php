<?php

namespace Database\Seeders;

use App\Models\Talla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Talla::insert([
            [
                'nombre' => 'Small',
            ],
            [
                'nombre' => 'Large',
            ],
            [
                'nombre' => 'Medium',
            ],
            [
                'nombre' => 'XL',
            ],
            [
                'nombre' => 'XX',
            ]
        ]);
    }
}
