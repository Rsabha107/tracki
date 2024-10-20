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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('workspace_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('email', 191)->unique();
            $table->string('country_code', 28)->nullable();
            $table->string('phone', 56);
            $table->string('password');
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode', 56);
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('lang', 28)->default('en');
            $table->text('remember_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
