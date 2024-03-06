<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('producto')->insert([
            'id' => 1,
            'nombre' => 'Labour',
            'descripcion' => '',
            'unidad_medida' => '',
            'precio_compra' => 0,
            'precio_venta' => 100,
            'usuario_id' => 1,
            'estado_producto_id' => 1,
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'proveedor_id' => 1,
            'tipo_medida_id' => 0,
        ]);
    }
}
