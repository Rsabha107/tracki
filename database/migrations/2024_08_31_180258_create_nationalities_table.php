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
        Schema::create('nationalities', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('num_code')->default(0);
            $table->string('alpha_2_code', 2)->nullable()->unique('alpha_2_code');
            $table->string('alpha_3_code', 3)->nullable()->unique('alpha_3_code');
            $table->string('en_short_name', 52)->nullable();
            $table->string('nationality', 39)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
};
