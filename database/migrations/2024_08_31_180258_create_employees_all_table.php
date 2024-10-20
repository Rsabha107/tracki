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
        Schema::create('employees_all', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('employee_number', 15);
            $table->string('national_identifier_number', 100)->nullable();
            $table->integer('salutation')->nullable();
            $table->string('first_name', 50);
            $table->string('middle_name')->nullable();
            $table->string('last_name', 50);
            $table->string('full_name', 500);
            $table->string('gender', 11);
            $table->integer('marital_status');
            $table->integer('employee_type')->nullable();
            $table->integer('entity_id');
            $table->integer('contract_type_id');
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('sponsorship_id', 150);
            $table->date('date_of_birth');
            $table->date('date_of_hire')->nullable();
            $table->date('join_date')->nullable();
            $table->string('town_of_birth', 100)->nullable();
            $table->string('country_of_birth', 11);
            $table->string('personal_email_address', 240);
            $table->string('work_email_address', 250);
            $table->string('phone_number', 50);
            $table->string('alt_phone_number', 50)->nullable();
            $table->integer('nationality');
            $table->integer('language')->nullable();
            $table->integer('reporting_to_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('directorate_id');
            $table->integer('functional_area_id');
            $table->integer('job_level_id');
            $table->date('civil_id_expiry')->nullable();
            $table->integer('passport_number');
            $table->date('passport_expiry');
            $table->string('profile_photo', 250)->nullable();
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
        Schema::dropIfExists('employees_all');
    }
};
