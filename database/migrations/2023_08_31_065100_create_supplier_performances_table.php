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
        Schema::create('supplier_performances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slack', 30)->nullable()->unique();
            $table->unsignedInteger('store_id')->index('supplier_performances_store_id_foreign');
            $table->unsignedInteger('supplier_id')->index('supplier_performances_supplier_id_foreign');
            $table->string('status', 100)->nullable();
            $table->string('address')->nullable();
            $table->string('delivery_timeline', 150)->nullable();
            $table->integer('rating_delivery_timeline')->nullable();
            $table->string('product_quality', 150)->nullable();
            $table->integer('rating_product_quality')->nullable();
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
};
