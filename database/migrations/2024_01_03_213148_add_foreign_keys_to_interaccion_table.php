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
        Schema::table('interaccion', function (Blueprint $table) {
            $table->foreign(['usuario_id'], 'interaccion_ibfk_3')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['galeria_proyecto_id'], 'interaccion_ibfk_4')->references(['id'])->on('galeria_proyecto')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interaccion', function (Blueprint $table) {
            $table->dropForeign('interaccion_ibfk_3');
            $table->dropForeign('interaccion_ibfk_4');
        });
    }
};
