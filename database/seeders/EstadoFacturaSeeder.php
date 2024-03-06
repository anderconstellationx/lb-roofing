<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estado_factura')->insert([
            'nombre' => 'Draft',
        ]);
        DB::table('estado_factura')->insert([
            'nombre' => 'Due',
        ]);
        DB::table('estado_factura')->insert([
            'nombre' => 'Paid',
        ]);
    }
}
