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
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono', 30)->nullable();
            $table->string('direccion', 500)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 60);
            $table->dateTime('nacimiento')->nullable();
            $table->string('documento', 60)->nullable();
            $table->string('genero', 20)->nullable();
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('rol_id')->index('rol_id');
            $table->unsignedBigInteger('estado_id')->index('estado_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};
