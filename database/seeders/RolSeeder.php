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
            ['tipo_rol' => 'Gerente', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Cajero', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Auxiliar de Cocina', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Limpieza', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Encargado de Plancha', 'url' =>'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Jefe de Almacen', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Jefe de Caja', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
            ['tipo_rol' => 'Jefe de Cocina', 'url' => 'https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public/rol'],
        ];

        Rol::insert($roles);
    }
}
