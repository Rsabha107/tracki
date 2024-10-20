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
        Schema::create('budget_fa_mapping', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('fa_name_id');
            $table->integer('budget_name_id');
            $table->integer('active_flag');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('created_by');
            $table->integer('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_fa_mapping');
    }
};
