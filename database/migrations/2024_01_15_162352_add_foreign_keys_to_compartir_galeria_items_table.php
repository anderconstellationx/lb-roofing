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
        Schema::table('compartir_galeria_items', function (Blueprint $table) {
            $table->foreign(['compartir_galeria_id'], 'compartir_galeria_items_ibfk_1')->references(['id'])->on('compartir_galeria')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['galeria_proyecto_id'], 'compartir_galeria_items_ibfk_2')->references(['id'])->on('galeria_proyecto')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compartir_galeria_items', function (Blueprint $table) {
            $table->dropForeign('compartir_galeria_items_ibfk_1');
            $table->dropForeign('compartir_galeria_items_ibfk_2');
        });
    }
};
