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
            // Add foreign key column patient_id
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            // Add foreign key column branch_id
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            
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
            // Drop foreign key constraints
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['branch_id']);

            // Drop columns
            $table->dropColumn(['patient_id', 'branch_id']);

            
        });
    }
};
