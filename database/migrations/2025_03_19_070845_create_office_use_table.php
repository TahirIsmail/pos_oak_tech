<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeUseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_use', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_detail_id')->constrained('interview_details')->onDelete('cascade'); // Foreign key to interview_details table
            $table->string('approved_by');
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('joining_date')->nullable();
            $table->string('probation_period')->nullable();
            $table->string('increment_probation')->nullable();
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
        Schema::dropIfExists('office_use');
    }
}
