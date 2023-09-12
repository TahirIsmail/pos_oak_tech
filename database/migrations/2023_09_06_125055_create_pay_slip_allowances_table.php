<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaySlipAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_slip_allowances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payslip_id')
            ->nullable()
            ->constrained('staff_payrolls');
            $table->string('allowance_type', 200);
            $table->float('amount');
            $table->foreignId('staff_id')
            ->nullable()
            ->constrained('users');
            $table->string('cal_type', 100);
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
        Schema::dropIfExists('pay_slip_allowances');
    }
}
