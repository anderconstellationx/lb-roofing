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
        Schema::create('proyecto_cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('producto_id')->index('producto_id');
            $table->unsignedBigInteger('proyecto_id')->index('proyecto_id');
            $table->unsignedBigInteger('usuario_id')->index('usuario_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_cotizacion');
    }
};
