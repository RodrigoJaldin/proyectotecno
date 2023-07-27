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
            ['tipo_rol' => 'Gerente', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Cajero', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Auxiliar de Cocina', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Limpieza', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Encargado de Plancha', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Jefe de Almacen', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Jefe de Caja', 'url' => $baseUrl.'/rol'],
            ['tipo_rol' => 'Jefe de Cocina', 'url' => $baseUrl.'/rol'],
        ];

        Rol::insert($roles);
    }
}
