<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::insert([
            [
                'nombre' => 'POLO MANGA CORTA',
            ],
            [
                'nombre' => 'POLO MANGA LARGA',
            ],
            [
                'nombre' => 'POLO DE RAYAS',
            ],
            [
                'nombre'=>'Polos con bolsillo en el pecho',
            ]
        ]);
    }
}
