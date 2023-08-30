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
        Schema::create('stock_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('return_number', 50)->unique();
            $table->date('return_date')->nullable();
            $table->string('bill_to', 30);
            $table->integer('bill_to_id');
            $table->string('bill_to_code', 30)->nullable();
            $table->string('bill_to_name', 250);
            $table->string('bill_to_email', 150)->nullable();
            $table->string('bill_to_contact', 15)->nullable();
            $table->text('bill_to_address')->nullable();
            $table->string('currency_name', 50)->nullable();
            $table->string('currency_code', 30)->nullable();
            $table->integer('tax_option_id')->nullable();
            $table->decimal('subtotal_excluding_tax', 13)->default(0);
            $table->decimal('total_discount_amount', 13)->default(0);
            $table->decimal('total_after_discount', 13)->default(0);
            $table->decimal('total_tax_amount', 13)->default(0);
            $table->decimal('shipping_charge', 13)->default(0);
            $table->decimal('packing_charge', 13)->default(0);
            $table->decimal('total_order_amount', 13)->default(0);
            $table->tinyInteger('update_stock')->default(0);
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['store_id', 'bill_to', 'bill_to_id', 'status'], 'return_indexes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_returns');
    }
};
