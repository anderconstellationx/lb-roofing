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
        Schema::table('gallery_report_items', function (Blueprint $table) {
            $table->foreign(['gallery_report_id'], 'gallery_report_items_ibfk_1')->references(['id'])->on('gallery_report')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['galeria_proyecto_id'], 'gallery_report_items_ibfk_2')->references(['id'])->on('galeria_proyecto')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_report_items', function (Blueprint $table) {
            $table->dropForeign('gallery_report_items_ibfk_1');
            $table->dropForeign('gallery_report_items_ibfk_2');
        });
    }
};
