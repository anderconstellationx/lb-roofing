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
        Schema::create('cliente_estado_cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36);
            $table->string('titulo');
            $table->unsignedBigInteger('cotizacion_id')->index('cotizacion_id');
            $table->longText('firma')->nullable();
            $table->string('comentario', 1000)->nullable();
            $table->longText('mensaje_cliente')->nullable();
            $table->integer('estado_cotizacion')->default(0);
            $table->unsignedBigInteger('usuario_id')->index('usuario_id')->comment('registrado por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_estado_cotizacion');
    }
};
