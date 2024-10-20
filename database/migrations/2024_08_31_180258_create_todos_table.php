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
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workspace_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->time('reminder')->nullable();
            $table->string('tags_id', 20)->nullable();
            $table->integer('priority_id');
            $table->boolean('is_completed')->default(false);
            $table->unsignedBigInteger('creator_id');
            $table->string('creator_type')->nullable();
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
        Schema::dropIfExists('todos');
    }
};
