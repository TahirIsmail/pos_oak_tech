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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('order_number', 30)->unique();
            $table->integer('customer_id');
            $table->string('customer_name', 250)->nullable();
            $table->string('customer_phone', 25)->nullable();
            $table->string('customer_email', 150)->nullable();
            $table->string('contact_number', 15)->nullable();
            $table->text('address')->nullable();
            $table->integer('register_id')->nullable()->index();
            $table->integer('store_level_discount_code_id')->nullable();
            $table->string('store_level_discount_code', 30)->nullable();
            $table->decimal('store_level_total_discount_percentage')->default(0);
            $table->decimal('store_level_total_discount_amount', 13)->default(0);
            $table->decimal('product_level_total_discount_amount', 13)->default(0);
            $table->integer('store_level_tax_code_id')->nullable();
            $table->string('store_level_tax_code', 30)->nullable();
            $table->decimal('store_level_total_tax_percentage')->default(0);
            $table->decimal('store_level_total_tax_amount', 13)->default(0);
            $table->text('store_level_total_tax_components')->nullable();
            $table->decimal('product_level_total_tax_amount', 13)->default(0);
            $table->decimal('purchase_amount_subtotal_excluding_tax', 13)->default(0);
            $table->decimal('sale_amount_subtotal_excluding_tax', 13)->default(0);
            $table->decimal('total_discount_before_additional_discount', 13)->default(0);
            $table->decimal('total_amount_before_additional_discount', 13)->default(0);
            $table->decimal('additional_discount_percentage')->default(0);
            $table->decimal('additional_discount_amount', 13)->default(0);
            $table->decimal('total_discount_amount', 13)->default(0);
            $table->decimal('total_after_discount', 13)->default(0);
            $table->decimal('total_tax_amount', 13)->default(0);
            $table->decimal('total_order_amount', 13)->default(0);
            $table->decimal('total_order_amount_rounded', 13, 0)->default(0);
            $table->integer('payment_method_id')->nullable()->index();
            $table->string('payment_method_slack', 30)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('currency_name', 50)->nullable();
            $table->string('currency_code', 30)->nullable();
            $table->integer('business_account_id')->nullable();
            $table->integer('order_type_id')->nullable();
            $table->string('order_type', 30)->nullable();
            $table->integer('restaurant_mode')->default(0);
            $table->integer('bill_type_id')->nullable();
            $table->string('bill_type', 150)->nullable();
            $table->integer('table_id')->nullable();
            $table->string('table_number', 250)->nullable();
            $table->integer('waiter_id')->nullable();
            $table->string('order_origin', 25)->default('POS_WEB')->index()->comment('POS_WEB, DIGITAL_MENU');
            $table->tinyInteger('status')->default(1);
            $table->integer('kitchen_status')->nullable()->index();
            $table->integer('payment_status')->default(0);
            $table->tinyInteger('order_merged')->default(0);
            $table->integer('order_merge_parent_id')->nullable();
            $table->tinyInteger('kitchen_screen_dismissed')->default(0);
            $table->tinyInteger('waiter_screen_dismissed')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('quantity_updated_on')->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'store_id', 'status']);
            $table->index(['payment_status', 'order_merged', 'order_merge_parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
