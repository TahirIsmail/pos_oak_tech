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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('product_code', 30);
            $table->string('name', 250);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('sub_category_id')->index('products_sub_category_id_foreign');
            $table->integer('supplier_id');
            $table->unsignedBigInteger('tax_code_id')->index('products_tax_code_id_foreign');
            $table->unsignedBigInteger('discount_code_id')->index('products_discount_code_id_foreign');
            $table->decimal('quantity')->default(0);
            $table->decimal('purchase_amount_excluding_tax', 13);
            $table->decimal('sale_amount_excluding_tax', 13);
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('created_by')->index('products_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('products_updated_by_foreign');
            $table->timestamps();
            $table->boolean('is_ingredient')->nullable();
            $table->boolean('is_ingredient_price')->nullable();
            $table->boolean('is_addon_product')->nullable();
            $table->decimal('alert_quantity', 10, 0)->nullable();
            $table->decimal('is_gredient_price', 10, 0)->nullable();
            $table->decimal('sale_amount_including_tax', 10, 0)->nullable();

            $table->index(['status', 'store_id', 'product_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
