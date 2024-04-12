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
        Schema::create('test_thirdparty', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('test_id')->nullable();

            $table->foreign('test_id')
                  ->references('id')->on('tests')
                  ->onDelete('cascade');

                  $table->unsignedBigInteger('thirdparty_id')->nullable();

                  $table->foreign('thirdparty_id')
                        ->references('id')->on('thirdparties')
                        ->onDelete('cascade');


            $table->string('given_time')->nullable();
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
        Schema::dropIfExists('test_thirdparty');
    }
};
