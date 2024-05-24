<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('engineer_id');
            $table->unsignedBigInteger('complaint_id');
            $table->enum('engineer_type', ['Field_Engineer', 'Lab_Engineer']);
            $table->string('request');
            $table->dateTime('start_request_time')->nullable();
            $table->dateTime('end_request_time')->nullable();
            $table->string('admin_remarks')->nullable();          
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
        Schema::dropIfExists('part_requests');
    }
}
