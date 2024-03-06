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
        Schema::create('template_cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento');
            $table->decimal('subtotal', 10)->default(0);
            $table->decimal('descuento', 10)->default(0);
            $table->decimal('total', 10)->default(0);
            $table->decimal('tax', 10)->default(0);
            $table->string('observaciones', 500)->nullable();
            $table->dateTime('fecha_creacion')->useCurrent();
            $table->dateTime('fecha_modificacion')->useCurrent();
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('usuario_id')->index('cotizacion_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_cotizacion');
    }
};
