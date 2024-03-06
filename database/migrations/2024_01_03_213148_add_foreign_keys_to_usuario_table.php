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
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign(['rol_id'], 'usuario_ibfk_3')->references(['id'])->on('rol')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['estado_id'], 'usuario_ibfk_4')->references(['id'])->on('estado')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('usuario_ibfk_3');
            $table->dropForeign('usuario_ibfk_4');
        });
    }
};
