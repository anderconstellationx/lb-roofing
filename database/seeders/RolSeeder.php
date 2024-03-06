<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol')->insert([
            'id' => 1,
            'nombre' => 'Administrators',
            'slug' => 'administrators',
            'descripcion' => '',
            'fecha_creacion' => now(),
        ]);
        DB::table('rol')->insert([
            'id' => 2,
            'nombre' => 'Sellers',
            'slug' => 'sellers',
            'descripcion' => '',
            'fecha_creacion' => now(),
        ]);
        DB::table('rol')->insert([
            'id' => 3,
            'nombre' => 'Accountants',
            'slug' => '',
            'descripcion' => '',
            'fecha_creacion' => now(),
        ]);
        DB::table('rol')->insert([
            'id' => 4,
            'nombre' => 'Clients',
            'slug' => '',
            'descripcion' => '',
            'fecha_creacion' => now(),
        ]);
    }
}
