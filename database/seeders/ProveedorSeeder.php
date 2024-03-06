<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //proveedor tiene nombre y marca
        DB::table('proveedor')->insert([
            'id' => 1,
            'nombre' => 'Internal',
            'marca' => 'Lb-Roofing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
