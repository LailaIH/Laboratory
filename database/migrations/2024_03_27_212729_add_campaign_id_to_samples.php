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
            $table->dropColumn('discount');
            $table->dropColumn('discount_note');
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('set null');
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
            $table->decimal('discount', 8, 2)->nullable();
            $table->string('discount_note')->nullable();
            $table->dropForeign(['campaign_id']);
            $table->dropColumn('campaign_id');
        });
    }
    
};
