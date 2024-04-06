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
        Schema::table('samples', function (Blueprint $table) {
            $table->dropForeign(['pationt_id']);
            $table->dropColumn('pationt_id');

            $table->dropForeign(['branche_id']);
            $table->dropColumn('branche_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->unsignedBigInteger('pationt_id');
            $table->foreign('pationt_id')->references('id')->on('patients');


            $table->unsignedBigInteger('branche_id');
            $table->foreign('branche_id')->references('id')->on('branches');
        });
    }
};
