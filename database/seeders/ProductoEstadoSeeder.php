<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estado_producto')->insert([
            'id' => 1, // 'id' => '1
            'nombre' => 'En Stock',
            'slug' => 'full-stock',
            'descripcion' => 'El producto se encuentra en stock',
            'usuario_id' => 1,
        ]);
        DB::table('estado_producto')->insert([
            'id' => 2, // 'id' => '2
            'nombre' => 'Agotado',
            'slug' => 'agotado',
            'descripcion' => 'Producto agotado',
            'usuario_id' => 1,
        ]);
    }
}
