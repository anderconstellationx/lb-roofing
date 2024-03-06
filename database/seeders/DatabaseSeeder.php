<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Estado;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // IMPORTAR BASE DE DATOS - SCRIPT SQL
        $sqlFilePath = base_path('database/sql/locations.sql');
        if (file_exists($sqlFilePath)) {
            $script = file_get_contents($sqlFilePath);
            DB::unprepared($script);
        }
        $this->call(RolSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ProductoEstadoSeeder::class);
        $this->call(ProyectoEstado::class);
        $this->call(TipoMedida::class);
        $this->call(TipoDireccionSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(EstadoCotizacionSeeder::class);
        $this->call(EstadoFacturaSeeder::class);
        $this->call(ProductosSeeder::class);
        //$this->call(ProyectoSeeder::class);
    }
}
