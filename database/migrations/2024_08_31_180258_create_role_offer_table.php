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
        Schema::create('role_offer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('functional_area_id')->nullable();
            $table->integer('active_flag');
            $table->integer('creator_id');
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
        Schema::dropIfExists('role_offer');
    }
};
