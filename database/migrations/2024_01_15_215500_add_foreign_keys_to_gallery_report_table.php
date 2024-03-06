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
        Schema::table('gallery_report', function (Blueprint $table) {
            $table->foreign(['usuario_id'], 'gallery_report_ibfk_1')->references(['id'])->on('usuario')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['proyecto_id'], 'gallery_report_ibfk_2')->references(['id'])->on('proyecto')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_report', function (Blueprint $table) {
            $table->dropForeign('gallery_report_ibfk_1');
            $table->dropForeign('gallery_report_ibfk_2');
        });
    }
};
