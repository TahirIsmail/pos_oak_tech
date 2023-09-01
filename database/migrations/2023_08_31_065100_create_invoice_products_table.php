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
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('invoice_id');
            $table->integer('product_id')->nullable();
            $table->string('product_slack', 30)->nullable();
            $table->string('product_code', 30)->nullable();
            $table->string('name', 250);
            $table->decimal('quantity')->default(0);
            $table->decimal('amount_excluding_tax', 13)->default(0);
            $table->decimal('subtotal_amount_excluding_tax', 13)->default(0);
            $table->decimal('discount_percentage')->default(0);
            $table->string('tax_type', 15)->default('EXCLUSIVE');
            $table->decimal('tax_percentage')->default(0);
            $table->decimal('discount_amount', 13)->default(0);
            $table->decimal('total_after_discount', 13)->default(0);
            $table->decimal('tax_amount', 13)->default(0);
            $table->text('tax_components')->nullable();
            $table->decimal('total_amount', 13)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['invoice_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_products');
    }
};
