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
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36);
            $table->char('uuid_client', 36);
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
            $table->boolean('is_template')->default(false);
            $table->unsignedBigInteger('proyecto_id')->index('cotizacion_proyecto');
            $table->unsignedBigInteger('usuario_id')->index('cotizacion_usuario');
            $table->unsignedBigInteger('estado_cotizacion_id')->default(1)->index('cotizacion_estado_cotizacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion');
    }
};
