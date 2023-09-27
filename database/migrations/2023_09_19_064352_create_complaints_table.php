<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->bigInteger('complaint_ref');
            $table->string('complaint_status');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedInteger('assign_to_lab_staff_id')->nullable();
            $table->string('lab_staff_remark')->nullable();
            $table->string('admin_remark')->nullable();
            $table->string('admin_again_remark')->nullable();;
            $table->date('due_date')->nullable();
            $table->text('description');
            $table->text('final_total_amount')->nullable();
            $table->text('final_lab_staff_remark')->nullable();
            $table->date('complaint_completed_date')->nullable();
            $table->text('description');
            $table->string('status')->default(0);
            $table->string('complaint_by');
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
        Schema::dropIfExists('complaints');
    }
}
