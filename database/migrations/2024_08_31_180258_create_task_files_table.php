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
        Schema::create('task_files', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('task_id');
            $table->string('file_name', 250);
            $table->string('original_file_name', 150);
            $table->string('file_extension', 10);
            $table->integer('file_size');
            $table->string('file_path', 150)->nullable();
            $table->integer('user_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_files');
    }
};