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
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion', 500)->nullable();
            $table->string('unidad_medida', 50)->nullable();
            $table->decimal('precio_compra', 10)->nullable()->default(0);
            $table->decimal('precio_venta', 10);
            $table->unsignedBigInteger('usuario_id')->index('usuario_id');
            $table->unsignedBigInteger('estado_producto_id')->index('producto_estado_producto')->default(\App\Models\EstadoProducto::STOCK);
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('proveedor_id')->nullable()->index('proveedor');
            $table->unsignedBigInteger('tipo_medida_id')->index('tipo_medida')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
};
