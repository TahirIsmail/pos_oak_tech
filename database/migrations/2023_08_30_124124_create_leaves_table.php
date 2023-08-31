<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')
              ->nullable()
              ->constrained('users')
              ->onDelete('set null');
              $table->foreignId('line_manager')
              ->nullable()
              ->constrained('users')
              ->onDelete('set null');
              $table->foreignId('leave_type_id')
              ->nullable()
              ->constrained('leave_types')
              ->onDelete('set null');
              $table->date('leave_from');
              $table->date('leave_to');
              $table->string('leave_days');
              $table->string('employee_remarks');
              $table->string('admin_remarks');
              $table->string('applied_by');
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
        Schema::dropIfExists('leaves');
    }
}
