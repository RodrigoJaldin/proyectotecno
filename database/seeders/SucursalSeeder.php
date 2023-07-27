<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sucursales = [
            [
                'nombre' => 'Sucursal 1',
                'direccion' => 'Av. Beni',
            ],
            [
                'nombre' => 'Sucursal Equipetrol',
                'direccion' => 'Av. Equipetrol',
            ],
        ];

        // Usar el modelo Eloquent para insertar los registros en la tabla "sucursal"
        Sucursal::insert($sucursales);
    }
}
