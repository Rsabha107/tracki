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
        Schema::create('check_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workspace_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('priority');
            $table->boolean('is_completed')->default(false);
            $table->unsignedBigInteger('creator_id');
            $table->string('creator_type');
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
        Schema::dropIfExists('check_lists');
    }
};
