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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->text('result')->nullable();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_online')->nullable();
            $table->string('status')->nullable();

            // Foreign key constraint
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');

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
        Schema::dropIfExists('test_results');
    }
};
