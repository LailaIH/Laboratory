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
            $table->dropForeign(['institu_id']);
            $table->dropColumn('institu_id');
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
            // Re-add the column
            $table->unsignedBigInteger('institu_id')->nullable();

            // Re-add the foreign key constraint
            $table->foreign('institu_id')->references('id')->on('institutes');
        });
    }
};
