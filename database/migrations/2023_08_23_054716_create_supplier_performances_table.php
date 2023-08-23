<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_performances', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->unsignedInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status');
            $table->string('address')->nullable();
            $table->string('delivery_timeline', 150)->nullable();
            $table->integer('rating_delivery_timeline')->nullable(); // Corrected 'int' to 'integer'
            $table->string('product_quality', 150)->nullable();
            $table->integer('rating_product_quality')->nullable(); // Corrected 'int' to 'integer'
            $table->string('responsiveness', 150)->nullable();
            $table->integer('rating_responsiveness')->nullable();
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
        Schema::dropIfExists('supplier_performances');
    }
}
