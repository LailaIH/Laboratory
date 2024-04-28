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
            $table->date('date_of_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('village')->nullable();
            $table->string('work_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->string('id_number')->nullable();
            $table->string('online_portal_information')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->text('patient_notes')->nullable();
            $table->string('address_on_map')->nullable();
            $table->string('img')->nullable(); // Assuming you'll store image paths here
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
            $table->dropColumn('date_of_birth');
            $table->dropColumn('city');
            $table->dropColumn('village');
            $table->dropColumn('work_address');
            $table->dropColumn('phone_number');
            $table->dropColumn('whatsapp_number');
            $table->dropColumn('email');
            $table->dropColumn('id_number');
            $table->dropColumn('online_portal_information');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('patient_notes');
            $table->dropColumn('address_on_map');
            $table->dropColumn('img');
        });
    }
};
