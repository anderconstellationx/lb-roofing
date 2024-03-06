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
        Schema::create('template_cotizacion_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('cantidad');
            $table->decimal('precio', 10);
            $table->decimal('descuento', 10)->nullable();
            $table->decimal('sub_total', 10);
            $table->decimal('total', 10);
            $table->decimal('tax', 10);
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificaion');
            $table->unsignedBigInteger('template_cotizacion_id')->index('template_cotizacion_item_cotizacion');
            $table->unsignedBigInteger('producto_id')->index('template_cotizacion_item_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_cotizacion_item');
    }
};
