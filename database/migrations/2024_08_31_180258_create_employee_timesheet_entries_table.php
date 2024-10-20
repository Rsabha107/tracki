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
        Schema::create('employee_timesheet_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_timesheet_id');
            $table->integer('employee_id');
            $table->unsignedBigInteger('user_id')->index('leave_requests_user_id_foreign');
            $table->integer('calendar_day');
            $table->string('day_action', 11);
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
        Schema::dropIfExists('employee_timesheet_entries');
    }
};
