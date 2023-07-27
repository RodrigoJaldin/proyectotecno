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
        $roles = [
            ['tipo_rol' => 'Gerente'],
            ['tipo_rol' => 'Cajero'],
            ['tipo_rol' => 'Auxiliar de Cocina'],
            ['tipo_rol' => 'Limpieza'],
            ['tipo_rol' => 'Encargado de Plancha'],
            ['tipo_rol' => 'Jefe de Almacen'],
            ['tipo_rol' => 'Jefe de Caja'],
            ['tipo_rol' => 'Jefe de Cocina'],
        ];

        Rol::insert($roles);
    }
}
