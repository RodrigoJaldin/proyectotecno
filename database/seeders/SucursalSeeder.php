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
        // Obtener la URL base dependiendo del entorno
        $baseUrl = env('APP_URL'); // Si estás en el entorno local, tomará esta URL
        // $baseUrl = env('APP_URL_CLOUD'); // Si estás en el entorno de producción en la nube, tomará esta URL

        $sucursales = [
            [
                'nombre' => 'Sucursal 1',
                'direccion' => 'Av. Beni',
                'url' => 'http://34.27.137.218/sucursal' // Agregar el segmento de la URL específico para la sucursal
            ],
            [
                'nombre' => 'Sucursal Equipetrol',
                'direccion' => 'Av. Equipetrol',
                'url' => 'http://34.27.137.218/sucursal' // Agregar el segmento de la URL específico para la sucursal
            ],
        ];

        // Usar el modelo Eloquent para insertar los registros en la tabla "sucursal"
        Sucursal::insert($sucursales);
    }
}
