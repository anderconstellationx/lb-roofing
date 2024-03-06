<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoEstado extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proyecto_estado')->insert([
            'nombre' => 'Quoting',
            'slug' => 'quoting',
            'descripcion' => 'The project is quoting',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);
        DB::table('proyecto_estado')->insert([
            'nombre' => 'Sent',
            'slug' => 'sent',
            'descripcion' => 'The project is sent',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);
        DB::table('proyecto_estado')->insert([
            'nombre' => 'In process',
            'slug' => 'in-process',
            'descripcion' => 'The project is in process',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);
        DB::table('proyecto_estado')->insert([
            'nombre' => 'Paused',
            'slug' => 'paused',
            'descripcion' => 'The project is paused',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);
        DB::table('proyecto_estado')->insert([
            'nombre' => 'Finished',
            'slug' => 'finished',
            'descripcion' => 'The project is finished',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);
        DB::table('proyecto_estado')->insert([
            'nombre' => 'Canceled',
            'slug' => 'canceled',
            'descripcion' => 'The project is canceled',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        ]);

    }
}
