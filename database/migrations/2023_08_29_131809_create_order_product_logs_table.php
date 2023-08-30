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
        Schema::create('order_product_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->decimal('quantity')->default(0);
            $table->tinyInteger('is_ready_to_serve')->default(0);
            $table->integer('edit_counter')->default(0);
            $table->tinyInteger('quantity_reduced')->nullable()->default(0);
            $table->decimal('previous_quantity')->nullable()->default(0);
            $table->tinyInteger('merged')->default(0);
            $table->integer('merged_from')->nullable();
            $table->integer('merged_to')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'product_id', 'is_ready_to_serve']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_logs');
    }
};
