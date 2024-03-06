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
        Schema::create('direccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion', 500);
            $table->unsignedBigInteger('tipo_direccion')->index('direccion_tipo_direccion');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('usuario_id')->index('direccion_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
};
