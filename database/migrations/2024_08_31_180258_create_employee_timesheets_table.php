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
        Schema::create('employee_timesheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->unsignedBigInteger('user_id')->index('leave_requests_user_id_foreign');
            $table->integer('month_selected_id');
            $table->string('year_selected', 10);
            $table->string('timesheet_period', 20);
            $table->integer('days_in_month');
            $table->integer('status_id');
            $table->unsignedBigInteger('action_by')->nullable();
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
        Schema::dropIfExists('employee_timesheets');
    }
};
