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
        Schema::create('business_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->integer('user_id');
            $table->integer('billing_counter_id')->nullable()->index();
            $table->integer('parent_register_id')->nullable();
            $table->tinyInteger('current_register')->default(0);
            $table->dateTime('opening_date');
            $table->dateTime('closing_date')->nullable();
            $table->dateTime('joining_date')->nullable();
            $table->dateTime('exit_date')->nullable();
            $table->decimal('opening_amount', 13)->default(0);
            $table->decimal('closing_amount', 13)->default(0);
            $table->integer('credit_card_slips')->default(0);
            $table->integer('cheques')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'store_id'], 'business_register_indexes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_registers');
    }
};
