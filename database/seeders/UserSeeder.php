<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear una entrada en la tabla 'personas'
        $persona = Persona::create([
            'razon_social' => 'pool', // Proveer un valor para 'razon_social'
            'direccion' => '123 Calle Falsa', // Proveer un valor para 'direccion'
            'tipo_persona' => 'Natural', // Proveer un valor para 'tipo_persona'
            'documento_id' => 1, // Asegúrate de que este ID exista en la tabla 'documentos'
            'numero_documento' => 73196982,
        ]);
        
        User::create([
            'name' => 'pool',
            'email' => 'pool@gmail.com',
            'password' => bcrypt('123456789'),
            'persona_id' => $persona->id, // Asignar el persona_id
        ])->assignRole('ADMIN');

    }
}
