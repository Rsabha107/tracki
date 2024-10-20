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
        Schema::create('employee_leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->unsignedBigInteger('user_id')->index('leave_requests_user_id_foreign');
            $table->integer('leave_type_id');
            $table->integer('number_of_days');
            $table->date('date_from');
            $table->date('date_to');
            $table->text('reason');
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
        Schema::dropIfExists('employee_leave_requests');
    }
};
