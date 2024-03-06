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
        Schema::table('template_cotizacion_item', function (Blueprint $table) {
            $table->foreign(['template_cotizacion_id'], 'template_cotizacion_item_ibfk_1')->references(['id'])->on('template_cotizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['producto_id'], 'template_cotizacion_item_ibfk_2')->references(['id'])->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['template_cotizacion_id'], 'template_cotizacion_item_ibfk_3')->references(['id'])->on('template_cotizacion')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['producto_id'], 'template_cotizacion_item_ibfk_4')->references(['id'])->on('producto')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_cotizacion_item', function (Blueprint $table) {
            $table->dropForeign('template_cotizacion_item_ibfk_1');
            $table->dropForeign('template_cotizacion_item_ibfk_2');
            $table->dropForeign('template_cotizacion_item_ibfk_3');
            $table->dropForeign('template_cotizacion_item_ibfk_4');
        });
    }
};
