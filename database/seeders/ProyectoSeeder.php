<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proyecto')->insert([
            'titulo' => 'Proyecto 1',
            'enlace' => '#',
            'fecha_inicio' => now(),
            'fecha_fin' => now(),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'direccion' => 'Calle 1',
            'observaciones' => 'Observaciones 1',
            'usuario_id' => 1,
            'proyecto_estado_id' => 1,
            'encargado_id' => 2,
            'cliente_id' => 3,
        ]);
    }
}
