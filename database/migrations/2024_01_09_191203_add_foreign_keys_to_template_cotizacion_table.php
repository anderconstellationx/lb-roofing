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
        Schema::table('template_cotizacion', function (Blueprint $table) {
            $table->foreign(['usuario_id'], 'template_cotizacion_ibfk_1')->references(['id'])->on('usuario')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_cotizacion', function (Blueprint $table) {
            $table->dropForeign('template_cotizacion_ibfk_1');
        });
    }
};