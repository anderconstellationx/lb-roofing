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
        Schema::table('factura_items', function (Blueprint $table) {
            $table->foreign(['factura_id'], 'factura_items_ibfk_1')->references(['id'])->on('factura')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['producto_id'], 'factura_items_ibfk_2')->references(['id'])->on('producto')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factura_items', function (Blueprint $table) {
            $table->dropForeign('factura_items_ibfk_1');
            $table->dropForeign('factura_items_ibfk_2');
        });
    }
};
