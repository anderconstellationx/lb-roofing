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
        Schema::table('producto', function (Blueprint $table) {
            $table->foreign(['estado_producto_id'], 'producto_ibfk_2')->references(['id'])->on('estado_producto')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'producto_ibfk_3')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['proveedor_id'], 'producto_ibfk_4')->references(['id'])->on('proveedor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto', function (Blueprint $table) {
            $table->dropForeign('producto_ibfk_2');
            $table->dropForeign('producto_ibfk_3');
            $table->dropForeign('producto_ibfk_4');
        });
    }
};
