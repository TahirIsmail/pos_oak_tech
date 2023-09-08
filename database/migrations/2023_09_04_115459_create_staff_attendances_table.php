<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->integer('store_id');

            $table->date('date');

            $table->foreignId('staff_id')
              ->nullable()
              ->constrained('users');
           
              $table->foreignId('staff_attendance_type_id')
              ->nullable()
              ->constrained('staff_attendance_types');

            $table->string('remark');


            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->index(['status', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_attendances');
    }
}
