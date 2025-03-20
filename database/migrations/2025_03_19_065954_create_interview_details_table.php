<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_details', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('name');
            $table->string('experience')->nullable();
            $table->string('personality')->nullable();
            $table->boolean('job_stability')->nullable();
            $table->string('willingness')->nullable();
            $table->boolean('family_background')->nullable();
            $table->boolean('conveyance')->nullable();
            $table->string('documents_attached')->nullable();
            $table->boolean('grading')->nullable();
            $table->decimal('last_salary', 10, 2)->nullable();
            $table->decimal('salary_agreed', 10, 2)->nullable();
            $table->boolean('interview_taken')->nullable();
            $table->boolean('selected')->default(0);
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
        Schema::dropIfExists('interview_details');
    }
}
