<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_to_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('action_by');
            $table->unsignedBigInteger('complaint_id');
            $table->enum('status', ['0', '1', '2'])->default(0);
            $table->string('request');
            $table->dateTime('start_request_time')->nullable();
            $table->dateTime('end_request_time')->nullable();
            $table->string('remarks')->nullable();          
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
        Schema::dropIfExists('request_to_stores');
    }
}
