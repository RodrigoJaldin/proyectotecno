<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseUrl = env('APP_URL');

        DB::table('user')->insert([
            'name' => 'Bernardo',
            'apellido' => 'Chavez',
            'ci' => '9874563',
            'telefono' => '71010463',
            'foto_user' => null,
            'codigo_empleado' => 'BM_0001',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'url' => $baseUrl.'/user',
            'id_rol' => '1',
            'id_sucursal' => null,
        ]);
    }
}
