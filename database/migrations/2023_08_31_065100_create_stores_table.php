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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->string('store_code', 30)->unique();
            $table->string('name', 250);
            $table->string('tax_number', 250)->nullable();
            $table->integer('tax_code_id')->nullable();
            $table->integer('discount_code_id')->nullable();
            $table->text('address')->nullable();
            $table->integer('country_id');
            $table->string('pincode', 15)->nullable();
            $table->string('primary_contact', 15)->nullable();
            $table->string('secondary_contact', 15)->nullable();
            $table->string('primary_email', 150)->nullable();
            $table->string('secondary_email', 150)->nullable();
            $table->string('invoice_type', 50)->default('SMALL');
            $table->string('currency_name', 50)->nullable();
            $table->string('currency_code', 30)->nullable()->default('USD');
            $table->integer('restaurant_mode')->default(0)->index();
            $table->integer('restaurant_chef_role_id')->nullable();
            $table->integer('restaurant_waiter_role_id')->nullable();
            $table->integer('restaurant_billing_type_id')->nullable();
            $table->tinyInteger('enable_customer_popup')->default(0);
            $table->tinyInteger('enable_variants_popup')->default(1);
            $table->tinyInteger('digital_menu_enabled')->default(1);
            $table->tinyInteger('enable_digital_menu_otp_verification')->default(1);
            $table->tinyInteger('digital_menu_send_order_to_kitchen')->default(0)->index();
            $table->integer('menu_language_id')->nullable();
            $table->time('menu_open_time')->nullable();
            $table->time('menu_close_time')->nullable();
            $table->tinyInteger('printnode_enabled')->default(0);
            $table->string('printnode_api_key', 100)->nullable();
            $table->integer('pos_printer_id')->nullable();
            $table->integer('kot_printer_id')->nullable();
            $table->integer('other_printer_id')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['enable_digital_menu_otp_verification', 'menu_language_id'], 'menu_otp_language_index');
            $table->index(['pos_printer_id', 'kot_printer_id', 'other_printer_id'], 'printer_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
