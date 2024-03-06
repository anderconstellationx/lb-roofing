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
        Schema::create('info_bussiness', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('nombre_mostrar')->nullable();
            $table->string('direccion');
            $table->string('telefono', 15);
            $table->string('correo');
            $table->string('rlegal_nombres')->nullable();
            $table->string('rlegal_apellidos')->nullable();
            $table->string('rlegal_correo')->nullable();
            $table->string('rlegal_telefono')->nullable();
            $table->string('sitio_web')->nullable();
            $table->string('info', 500)->nullable();
            $table->string('logo')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->string('moneda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_bussiness');
    }
};
