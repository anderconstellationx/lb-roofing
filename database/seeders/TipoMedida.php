<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMedida extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_medida')->insert([
            'id' => 1,
            'medida' => 'Kilogram',
            'sufijo' => 'Kg',
            'slug' => 'kilogram',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 2,
            'medida' => 'Liter',
            'sufijo' => 'L',
            'slug' => 'liter',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 3,
            'medida' => 'Meter',
            'sufijo' => 'M',
            'slug' => 'meter',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 4,
            'medida' => 'Unit',
            'sufijo' => 'U',
            'slug' => 'unit',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 5,
            'medida' => 'Centimeter',
            'sufijo' => 'Cm',
            'slug' => 'centimeter',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 6,
            'medida' => 'Milliliter',
            'sufijo' => 'Ml',
            'slug' => 'Milliliter',
        ]);
        DB::table('tipo_medida')->insert([
            'id' => 7,
            'medida' => 'Gram',
            'sufijo' => 'G',
            'slug' => 'gram',
        ]);
    }
}
