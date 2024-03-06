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
        Schema::table('cotizacion_item', function (Blueprint $table) {
            $table->foreign(['cotizacion_id'], 'cotizacion_item_ibfk_1')->references(['id'])->on('cotizacion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['producto_id'], 'cotizacion_item_ibfk_2')->references(['id'])->on('producto')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacion_item', function (Blueprint $table) {
            $table->dropForeign('cotizacion_item_ibfk_1');
            $table->dropForeign('cotizacion_item_ibfk_2');
        });
    }
};
