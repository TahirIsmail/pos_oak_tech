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
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('order_id');
            $table->integer('parent_order_product_id')->nullable()->index();
            $table->integer('product_id');
            $table->string('product_slack', 30);
            $table->string('product_code', 30);
            $table->string('name', 250);
            $table->decimal('quantity');
            $table->decimal('purchase_amount_excluding_tax', 13);
            $table->decimal('sale_amount_excluding_tax', 13);
            $table->decimal('sale_amount_including_tax', 13)->default(0);
            $table->integer('discount_code_id')->nullable();
            $table->string('discount_code', 30)->nullable();
            $table->decimal('discount_percentage')->default(0);
            $table->integer('tax_code_id')->nullable();
            $table->string('tax_code', 30)->nullable();
            $table->decimal('tax_percentage')->default(0);
            $table->text('tax_components')->nullable();
            $table->decimal('sub_total_purchase_price_excluding_tax', 13);
            $table->decimal('sub_total_sale_price_excluding_tax', 13);
            $table->decimal('discount_amount', 13)->default(0);
            $table->decimal('total_after_discount', 13)->default(0);
            $table->decimal('tax_amount', 13)->default(0);
            $table->decimal('total_amount', 13);
            $table->tinyInteger('is_ready_to_serve')->default(0);
            $table->integer('merged_from')->nullable();
            $table->integer('merged_to')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['merged_from', 'merged_to']);
            $table->index(['order_id', 'product_id', 'product_code', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
};
