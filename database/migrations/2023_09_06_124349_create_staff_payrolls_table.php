<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')
            ->nullable()
            ->constrained('users');
            $table->float('basic', 10, 2);
            $table->float('total_allowance', 10, 2)->nullable();
            $table->float('total_deduction', 10, 2)->nullable();
            $table->float('pf_deduction', 10, 2)->nullable();
            $table->float('this_month_pf', 10, 2)->nullable();
            $table->integer('leave_deduction')->nullable();
            $table->string('tax', 200);
            $table->float('net_salary', 10, 2);
            $table->string('status', 100);
            $table->string('month', 200);
            $table->string('year', 200);
            $table->string('payment_mode', 200)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('remark', 200)->nullable();
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
        Schema::dropIfExists('staff_payrolls');
    }
}
