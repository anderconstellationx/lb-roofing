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
        Schema::table('compartir_galeria', function (Blueprint $table) {
            $table->foreign(['usuario_id'], 'compartir_galeria_ibfk_1')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['proyecto_id'], 'compartir_galeria_ibfk_2')->references(['id'])->on('proyecto')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compartir_galeria', function (Blueprint $table) {
            $table->dropForeign('compartir_galeria_ibfk_1');
            $table->dropForeign('compartir_galeria_ibfk_2');
        });
    }
};
