<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_direccion')->insert([
            [
                'nombre' => 'Home',
                'fecha_creacion' => now(),
                'fecha_modificacion' => now(),
            ],
            [
                'nombre' => 'Work',
                'fecha_creacion' => now(),
                'fecha_modificacion' => now(),
            ],
            [
                'nombre' => 'Other',
                'fecha_creacion' => now(),
                'fecha_modificacion' => now(),
            ],
        ]);
    }
}
