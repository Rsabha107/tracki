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
        Schema::create('client_workspace', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workspace_id');
            $table->unsignedBigInteger('client_id')->index('client_workspace_client_id_foreign');

            $table->unique(['workspace_id', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_workspace');
    }
};
