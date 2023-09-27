<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_charges', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->unsignedBigInteger('complaint_id');
            $table->string('charge_label');
            $table->decimal('charge_price', 13,2);
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
        Schema::dropIfExists('complaint_charges');
    }
}
