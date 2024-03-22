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
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('institu_id')->nullable();
            $table->string('period_time')->nullable();
            $table->text('pation_note')->nullable();
            $table->json('analysis_id')->nullable();
            $table->unsignedBigInteger('branche_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('pationt_id')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('gross_amount', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('remain_amount', 10, 2)->nullable();
            $table->text('money_note')->nullable();
            $table->text('discount_note')->nullable();
            $table->enum('status', ['pending', 'completed', 'canceled'])->nullable()->default('pending');
            $table->boolean('is_online')->nullable()->default(false);
            $table->boolean('is_approved')->nullable()->default(false);
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('institu_id')->references('id')->on('institus')->onDelete('set null');
            $table->foreign('branche_id')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->foreign('pationt_id')->references('id')->on('patients')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samples');
    }
};
