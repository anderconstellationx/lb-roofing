<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36);
            $table->string('titulo');
            $table->string('codigo_factura', 50)->nullable();
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento');
            $table->decimal('subtotal', 10);
            $table->decimal('descuento', 10)->nullable();
            $table->decimal('total', 10);
            $table->unsignedBigInteger('es_proyecto')->nullable()->default(1);
            $table->string('observaciones')->nullable();
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('usuario_id')->index('usuario_id')->comment('Usuario que crea la factura');
            $table->unsignedBigInteger('usuario_cliente_id')->index('usuario_cliente_id');
            $table->unsignedBigInteger('proyecto_id')->index('proyecto_id');
            $table->unsignedBigInteger('cotizacion_id')->index('cotizacion_id');
            $table->unsignedBigInteger('estado_factura_id')->index('estado_factura_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
};
