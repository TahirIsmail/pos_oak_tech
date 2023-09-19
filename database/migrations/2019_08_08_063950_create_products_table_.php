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
            $table->string('name', 250);
            $table->text('description')->nullable();
            $table->foreignId('sub_category_id')
                ->constrained('sub_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('supplier_id');
            // $table->integer('tax_code_id');
            $table->foreignId('tax_code_id')
            ->constrained('tax_codes')
            ->onUpdate('cascade');

            // $table->integer('discount_code_id')->nullable();
            $table->foreignId('discount_code_id')
            ->constrained('discount_codes')
            ->onUpdate('cascade');



            $table->decimal('quantity', 8, 2)->default(0);
            $table->decimal('purchase_amount_excluding_tax', 13, 2);
            $table->decimal('sale_amount_excluding_tax', 13, 2);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('created_by')
            ->constrained('users')
            ->onUpdate('cascade');
            // $table->integer('created_by')->nullable();
            // $table->integer('updated_by')->nullable();
            $table->foreignId('updated_by')
            ->constrained('users')
            ->onUpdate('cascade')->nullable();
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
