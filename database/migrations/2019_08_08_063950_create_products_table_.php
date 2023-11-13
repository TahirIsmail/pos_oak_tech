<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            $table->string('name', 250)->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('category_company_id')->nullable();
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->unsignedBigInteger('product_name_id')->nullable();


            $table->integer('supplier_id');
            $table->foreignId('tax_code_id')
            ->constrained('tax_codes')
            ->onUpdate('cascade');
            $table->foreignId('discount_code_id')
            ->constrained('discount_codes')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('link_to_complaint')->nullable();
            $table->unsignedBigInteger('link_to_project')->nullable();
            $table->decimal('quantity', 8, 2)->default(0);
            $table->decimal('alert_quantity', 8, 2)->default(0);
            $table->decimal('purchase_amount_excluding_tax', 13, 2);
            $table->decimal('sale_amount_excluding_tax', 13, 2);
            $table->decimal('sale_amount_including_tax', 13, 2);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('created_by')
            ->constrained('users')
            ->onUpdate('cascade');
            $table->integer('is_ingredient')->nullable();
            $table->integer('is_ingredient_price')->nullable();
            $table->integer('is_addon_product')->nullable();
            $table->decimal('is_gredient_pride', 13, 2)->nullable();
            // $table->integer('updated_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
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
}
