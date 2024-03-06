<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estado')->insert([
            'nombre' => 'Active',
            'slug' => 'active',
            'descripcion' => 'Status Active',
        ]);
        DB::table('estado')->insert([
            'nombre' => 'Inactive',
            'slug' => 'inactive',
            'descripcion' => 'Estado inactivo',
        ]);
    }
}
