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
        Schema::table('cotizacion', function (Blueprint $table) {
            $table->foreign(['proyecto_id'], 'cotizacion_ibfk_4')->references(['id'])->on('proyecto')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['estado_cotizacion_id'], 'cotizacion_ibfk_5')->references(['id'])->on('estado_cotizacion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'cotizacion_ibfk_6')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacion', function (Blueprint $table) {
            $table->dropForeign('cotizacion_ibfk_4');
            $table->dropForeign('cotizacion_ibfk_5');
            $table->dropForeign('cotizacion_ibfk_6');
        });
    }
};
