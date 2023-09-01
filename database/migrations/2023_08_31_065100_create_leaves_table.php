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
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_id')->nullable()->index('leaves_staff_id_foreign');
            $table->unsignedBigInteger('line_manager')->nullable()->index('leaves_line_manager_foreign');
            $table->unsignedBigInteger('leave_type_id')->nullable()->index('leaves_leave_type_id_foreign');
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
};
