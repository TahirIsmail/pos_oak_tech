<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_performance', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('products');

            $table->string('supplier_code', 30);
            $table->string('name', 250);
            $table->string('orders', 150)->nullable();
            $table->mediumText('description')->nullable();
            $table->text('address')->nullable();
            $table->string('rating')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->index(['status', 'store_id', 'supplier_code']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_performance');
    }
}
