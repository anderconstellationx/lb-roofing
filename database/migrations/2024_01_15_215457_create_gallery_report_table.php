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
        Schema::create('gallery_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid();
            $table->string('title');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('gallery_report');
    }
};
