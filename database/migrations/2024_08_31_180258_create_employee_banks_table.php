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
        Schema::create('employee_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->unsignedBigInteger('user_id')->index('leave_requests_user_id_foreign');
            $table->string('bank_branch_name', 100);
            $table->string('bank_account_name', 100);
            $table->string('iban', 50);
            $table->string('swift_code', 50);
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
        Schema::dropIfExists('employee_banks');
    }
};
