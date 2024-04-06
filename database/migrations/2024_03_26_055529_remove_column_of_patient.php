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
        Schema::table('patients', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['doctor_id']);

            // Drop the column
            $table->dropColumn('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Re-add the column
            $table->unsignedBigInteger('doctor_id')->nullable();

            // Re-add the foreign key constraint
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
};
