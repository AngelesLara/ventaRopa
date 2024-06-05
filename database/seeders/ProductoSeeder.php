<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'codigo' => 'P001',
                'nombre' => 'Polo celeste',
                'stock' => 50,
                'descripcion' => 'Camiseta de algodón celetes de alta calidad',
                'precio' => 19.99,
                'img_path' => 'productos/3lMudSGaUrXjnAGyLiF99sPhMqJiY7CealR8atux.webp',
                'categoria_id' => 1,
                'color_id' => 1,
                'talla_id' => 1,
                'marca_id' => 1,
            ],
            [
                'codigo' => 'P002',
                'nombre' => 'Polo de rallas',
                'stock' => 30,
                'descripcion' => 'polo de rallas negras y blancas.',
                'precio' => 39.99,
                'img_path' => 'productos/KcHiO04nHLqYZLtHZEXa4xKzmkYHukH0OAAGxird.webp',
                'categoria_id' => 2,
                'color_id' => 2,
                'talla_id' => 2,
                'marca_id' => 2,
            ],
            [
                'codigo' => 'P003',
                'nombre' => 'Polo plomo',
                'stock' => 20,
                'descripcion' => 'polo cuello v de color plomo',
                'precio' => 59.99,
                'img_path' => 'productos/ZeavXnZtcHb0bQg4wpCZQoAc7PpAAlpsAlkgRcyB.webp',
                'categoria_id' => 1,
                'color_id' => 3,
                'talla_id' => 1,
                'marca_id' => 2,
            ],
            [
                'codigo' => 'P004',
                'nombre' => 'Polo negro',
                'stock' => 15,
                'descripcion' => 'polo negro para caminar',
                'precio' => 39.99,
                'img_path' => 'productos/uOXcfmKN8vXe0eRaqVGZtmzpNS4P8bIaLjYT1dbc.webp',
                'categoria_id' => 3,
                'color_id' => 2,
                'talla_id' => 3,
                'marca_id' => 1,
            ],
            [
                'codigo' => 'P005',
                'nombre' => 'Polo Roja',
                'stock' => 100,
                'descripcion' => 'Polo roja con logo bordado',
                'precio' => 49.99,
                'img_path' => 'productos/wN1W4mJoSZS2SUDRKwu7yAMVrkHBx2x7Y4KWh2Pt.webp',
                'categoria_id' => 2,
                'color_id' => 1,
                'talla_id' => 2,
                'marca_id' => 2,
            ],
        ];

        DB::table('productos')->insert($productos);
    }
}
