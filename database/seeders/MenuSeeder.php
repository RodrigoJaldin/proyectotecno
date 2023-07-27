<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $menu = [
            [
                'nombre' => 'Menu Normal',
                'url' => 'modo-normal-btn',
                'user_id' => '1',
            ],
            [
                'nombre' => 'Menu Niño',
                'url' => 'modo-nino-btn',
                'user_id' =>'1',

            ],
            [
                'nombre' => 'Menu Joven',
                'url' => 'modo-joven-btn',
                'user_id' => '1',

            ],
            [
                'nombre' => 'Menu Adulto',
                'url' => 'modo-adulto-btn',
                'user_id' => '1',

            ],
        ];
        Menu::insert($menu);

    }
}
