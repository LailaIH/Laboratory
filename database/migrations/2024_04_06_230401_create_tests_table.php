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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->decimal('price',10, 2);
            $table->decimal('normal_rate',10, 2)->nullable();
            $table->string('sample_type')->nullable();
            $table->string('sample_quantity')->nullable();
            $table->string('preservation_type')->nullable();
            $table->string('transfer_type')->nullable();
            $table->boolean('is_available')->default(true);
            

            $table->json('results')->nullable();
            $table->json('test_unit')->nullable();
            $table->text('test_importance')->nullable();
            $table->string('sop')->nullable();
            $table->string('machine')->nullable();
            $table->boolean('doctor_approval_need')->default(true);
            $table->boolean('manager_approval_need')->default(true);
            $table->boolean('admin_approval_need')->default(true);
            $table->string('time_needed')->nullable();





            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');





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
        Schema::dropIfExists('tests');
    }
};
