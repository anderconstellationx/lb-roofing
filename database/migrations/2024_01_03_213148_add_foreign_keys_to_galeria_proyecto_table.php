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
        Schema::table('galeria_proyecto', function (Blueprint $table) {
            $table->foreign(['proyecto_id'], 'galeria_proyecto_ibfk_3')->references(['id'])->on('proyecto')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'galeria_proyecto_ibfk_4')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galeria_proyecto', function (Blueprint $table) {
            $table->dropForeign('galeria_proyecto_ibfk_3');
            $table->dropForeign('galeria_proyecto_ibfk_4');
        });
    }
};
