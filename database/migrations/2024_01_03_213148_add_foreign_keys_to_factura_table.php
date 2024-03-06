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
        Schema::table('factura', function (Blueprint $table) {
            $table->foreign(['usuario_cliente_id'], 'factura_ibfk_10')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'factura_ibfk_6')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['proyecto_id'], 'factura_ibfk_7')->references(['id'])->on('proyecto')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['estado_factura_id'], 'factura_ibfk_8')->references(['id'])->on('estado_factura')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['cotizacion_id'], 'factura_ibfk_9')->references(['id'])->on('cotizacion')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->dropForeign('factura_ibfk_10');
            $table->dropForeign('factura_ibfk_6');
            $table->dropForeign('factura_ibfk_7');
            $table->dropForeign('factura_ibfk_8');
            $table->dropForeign('factura_ibfk_9');
        });
    }
};
