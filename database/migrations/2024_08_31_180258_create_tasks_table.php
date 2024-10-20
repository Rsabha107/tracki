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
        Schema::create('tasks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('workspace_id');
            $table->string('name', 300);
            $table->date('start_date');
            $table->date('due_date');
            $table->integer('department_assignment_id');
            $table->integer('assignment_id')->nullable();
            $table->string('assignment_to_id', 100);
            $table->decimal('budget_allocation', 11)->nullable();
            $table->decimal('actual_budget_allocated', 11)->nullable();
            $table->integer('event_id');
            $table->integer('status_id');
            $table->integer('duration')->nullable();
            $table->decimal('progress', 11)->nullable();
            $table->integer('parent')->nullable();
            $table->integer('color_id')->nullable();
            $table->text('description');
            $table->integer('type')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('tasks');
    }
};
