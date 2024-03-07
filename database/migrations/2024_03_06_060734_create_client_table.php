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
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('document', 50)->nullable();
            $table->unsignedBigInteger('countries_id')->index('countries_id');
            $table->unsignedBigInteger('states_id')->index('states_id');
            $table->unsignedBigInteger('cities_id')->index('cities_id');
            $table->float('address', 10, 0)->unsigned()->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->unsignedInteger('genre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
};
