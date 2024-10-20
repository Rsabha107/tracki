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
        Schema::create('events', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('workspace_id');
            $table->integer('project_type_id');
            $table->string('name', 100);
            $table->integer('category_id')->nullable();
            $table->string('language', 50)->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('audience_id')->nullable();
            $table->integer('venue_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('progress', 10)->nullable();
            $table->integer('parent')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('budget_allocation')->nullable();
            $table->integer('attendance_forcast')->nullable();
            $table->integer('time_zone')->nullable();
            $table->text('description')->nullable();
            $table->integer('event_status')->nullable();
            $table->string('archived', 5)->nullable();
            $table->string('type', 11)->nullable()->default('project');
            $table->boolean('open')->nullable()->default(true);
            $table->integer('total_sales')->nullable()->default(0);
            $table->integer('fund_category_id')->nullable();
            $table->integer('functional_area_id')->nullable();
            $table->integer('operation_id')->nullable();
            $table->integer('segment_id')->nullable();
            $table->integer('budget_name_id')->nullable();
            $table->integer('org_id')->nullable();
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
        Schema::dropIfExists('events');
    }
};
