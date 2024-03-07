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
        Schema::table('client', function (Blueprint $table) {
            $table->foreign(['countries_id'], 'client_ibfk_1')->references(['id'])->on('countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['states_id'], 'client_ibfk_2')->references(['id'])->on('states')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['cities_id'], 'client_ibfk_3')->references(['id'])->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign('client_ibfk_1');
            $table->dropForeign('client_ibfk_2');
            $table->dropForeign('client_ibfk_3');
        });
    }
};
