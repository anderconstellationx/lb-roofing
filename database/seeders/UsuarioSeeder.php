<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            'nombres' => 'Your Best',
            'apellidos' => 'Admin',
            'email' => 'support@lbroofing.rachellesstore.com',
            'password' => Hash::make('admin'),
            'documento' => 123456789,
            'genero' => 1,
            'estado_id' => 1,
            'rol_id' => 1,
            'nacimiento' => now(),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
        ]);
        DB::table('usuario')->insert([
            'nombres' => 'Jesus Sideral',
            'apellidos' => 'Lujan Carrion',
            'email' => 'employ@lbroofing.rachellesstore.com',
            'password' => Hash::make('roofing2024'),
            'documento' => 123456789,
            'genero' => 2,
            'estado_id' => 1,
            'rol_id' => 2,
            'nacimiento' => now(),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
        ]);
        DB::table('usuario')->insert([
            'nombres' => 'Angel',
            'apellidos' => 'Perez Ruiz',
            'email' => 'receptor@lbroofing.rachellesstore.com',
            'password' => Hash::make('roofing2024'),
            'documento' => 123456789,
            'genero' => 1,
            'estado_id' => 1,
            'rol_id' => 3,
            'nacimiento' => now(),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
        ]);
        DB::table('usuario')->insert([
            'nombres' => 'Juan',
            'apellidos' => 'Perez Perez',
            'email' => 'pruebas.roofing@lbroofing.rachellesstore.com',
            'password' => Hash::make('roofing2024'),
            'documento' => 123456789,
            'genero' => 1,
            'estado_id' => 1,
            'rol_id' => 4,
            'nacimiento' => now(),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
        ]);
    }
}
