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
        Schema::table('cliente_estado_cotizacion', function (Blueprint $table) {
            $table->foreign(['cotizacion_id'], 'cliente_estado_cotizacion_ibfk_1')->references(['id'])->on('cotizacion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'cliente_estado_cotizacion_ibfk_2')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente_estado_cotizacion', function (Blueprint $table) {
            $table->dropForeign('cliente_estado_cotizacion_ibfk_1');
            $table->dropForeign('cliente_estado_cotizacion_ibfk_2');
        });
    }
};
