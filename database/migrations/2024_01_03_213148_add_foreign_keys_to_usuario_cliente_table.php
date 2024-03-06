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
        Schema::table('usuario_cliente', function (Blueprint $table) {
            $table->foreign(['tipo_cliente_id'], 'usuario_cliente_ibfk_1')->references(['id'])->on('tipo_cliente')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'], 'usuario_cliente_ibfk_2')->references(['id'])->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_cliente', function (Blueprint $table) {
            $table->dropForeign('usuario_cliente_ibfk_1');
            $table->dropForeign('usuario_cliente_ibfk_2');
        });
    }
};
