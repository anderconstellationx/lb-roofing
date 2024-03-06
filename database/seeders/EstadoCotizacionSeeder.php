<?php

namespace Database\Seeders;

use App\Models\EstadoCotizacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class EstadoCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (EstadoCotizacion::STATUS as $key => $status) {
            $newStatus = new EstadoCotizacion();
            $newStatus->id = $key;
            $newStatus->nombre = $status;
            $newStatus->save();
        }
    }
}
