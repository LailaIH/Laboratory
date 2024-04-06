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
        Schema::table('invoices', function (Blueprint $table) {
            // Add user_id column
            $table->unsignedBigInteger('user_id')->nullable();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Add status column
            $table->string('status')->nullable();

            // Add is_online column
            $table->boolean('is_online')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['user_id']);

            // Drop the added columns if the migration is rolled back
            $table->dropColumn('user_id');
            $table->dropColumn('status');
            $table->dropColumn('is_online');
        });
    }
};
