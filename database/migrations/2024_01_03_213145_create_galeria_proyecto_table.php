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
        Schema::create('galeria_proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('nombre_original');
            $table->string('path');
            $table->dateTime('fecha_creacion');
            $table->boolean('visible')->default(true)->comment('visibilidad de la imagen');
            $table->string('type');
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
        Schema::dropIfExists('galeria_proyecto');
    }
};
