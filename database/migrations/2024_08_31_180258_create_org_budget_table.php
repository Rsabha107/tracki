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
        Schema::create('org_budget', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('org_id');
            $table->integer('budget_name_id');
            $table->string('type', 25);
            $table->decimal('budget_amount', 11);
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('active_flag');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('org_budget');
    }
};
