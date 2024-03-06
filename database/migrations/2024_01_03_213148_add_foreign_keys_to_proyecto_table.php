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
        Schema::table('proyecto', function (Blueprint $table) {
            $table->foreign(['proyecto_estado_id'], 'proyecto_ibfk_4')->references(['id'])->on('proyecto_estado')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_cliente_id'], 'proyecto_ibfk_5')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'proyecto_ibfk_6')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_encargado_id'], 'proyecto_ibfk_7')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto', function (Blueprint $table) {
            $table->dropForeign('proyecto_ibfk_4');
            $table->dropForeign('proyecto_ibfk_5');
            $table->dropForeign('proyecto_ibfk_6');
            $table->dropForeign('proyecto_ibfk_7');
        });
    }
};
