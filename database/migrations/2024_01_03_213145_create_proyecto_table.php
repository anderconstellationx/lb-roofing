<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo')->nullable();
            $table->string('enlace_galeria', 500)->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_fin')->nullable();
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('countries_id')->index('countries_id');
            $table->unsignedBigInteger('state_id')->index('state_id');
            $table->unsignedBigInteger('cities_id')->index('cities_id');
            $table->string('direccion', 500)->nullable();
            $table->string('observaciones', 500)->nullable();
            $table->unsignedBigInteger('usuario_encargado_id')->index('proyecto_encargado_id');
            $table->unsignedBigInteger('proyecto_estado_id')->index('proyecto_estado_id');
            $table->unsignedBigInteger('usuario_id')->index('usuario_id');
            $table->unsignedBigInteger('usuario_cliente_id')->index('usuario_cliente_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto');
    }
};
