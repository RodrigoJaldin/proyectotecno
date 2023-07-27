<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $baseUrl = env('APP_URL');

        $roles = [
            ['tipo_rol' => 'Gerente', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Cajero', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Auxiliar de Cocina', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Limpieza', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Encargado de Plancha', 'url' =>'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Jefe de Almacen', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Jefe de Caja', 'url' => 'http://34.27.137.218/rol'],
            ['tipo_rol' => 'Jefe de Cocina', 'url' => 'http://34.27.137.218/rol'],
        ];

        Rol::insert($roles);
    }
}
