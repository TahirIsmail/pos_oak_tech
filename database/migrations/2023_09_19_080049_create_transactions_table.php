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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('transaction_code', 30)->unique();
            $table->integer('account_id');
            $table->integer('transaction_type');
            $table->integer('payment_method_id')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('bill_to', 50)->nullable()->comment('CUSTOMER_ORDER, INVOICE, CUSTOMER, SUPPLIER, STAFF');
            $table->integer('bill_to_id')->nullable();
            $table->string('bill_to_name', 250)->nullable();
            $table->string('bill_to_contact', 150)->nullable();
            $table->text('bill_to_address')->nullable();
            $table->string('currency_code', 30);
            $table->decimal('amount', 13)->default(0);
            $table->decimal('received_amount', 13)->default(0);
            $table->text('notes')->nullable();
            $table->string('pg_transaction_id', 250)->nullable();
            $table->string('pg_transaction_status', 100)->nullable();
            $table->date('transaction_date')->nullable();
            $table->tinyInteger('transaction_merged')->default(0);
            $table->integer('merged_from')->nullable();
            $table->integer('merged_to')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['store_id', 'account_id', 'transaction_type', 'bill_to', 'bill_to_id'], 'transaction_indexes');
            $table->index(['merged_from', 'merged_to']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
