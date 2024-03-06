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
        Schema::create('compartir_galeria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link', 10);
            $table->unsignedBigInteger('proyecto_id')->index('proyecto_id');
            $table->unsignedBigInteger('usuario_id')->index('usuario_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compartir_galeria');
    }
};
