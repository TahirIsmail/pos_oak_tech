<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryChallansTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_challans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');

            $table->string('delivery_challan_number', 50)->unique();
            $table->string('delivery_challan_reference', 30)->nullable();
            $table->date('delivery_challan_date')->nullable();
            $table->date('delivery_due_date')->nullable();
            
            $table->integer('parent_po_id')->nullable();
            $table->string('bill_to', 30);
            $table->boolean('delivery_against_po_from_customer')->default(false);
            
            $table->integer('bill_to_id');
            $table->string('bill_to_code', 30)->nullable();
            $table->string('bill_to_name', 250);
            $table->string('bill_to_email', 150)->nullable();
            $table->string('bill_to_contact', 15)->nullable();
            $table->text('bill_to_address')->nullable();

            $table->integer('bill_from_id')->nullable();
            $table->string('bill_from_code', 30)->nullable();
            $table->string('bill_from_name', 250)->nullable();
            $table->string('bill_from_email', 150)->nullable();
            $table->string('bill_from_contact', 15)->nullable();
            $table->text('bill_from_address')->nullable();

            $table->string('currency_name', 50)->nullable();
            $table->string('currency_code', 30)->nullable();
            
            $table->integer('tax_option_id')->nullable();
            
            $table->decimal('subtotal_excluding_tax', 13, 2)->default(0);
            $table->decimal('total_discount_amount', 13, 2)->default(0);
            $table->decimal('total_after_discount', 13, 2)->default(0);
            $table->decimal('total_tax_amount', 13, 2)->default(0);
            $table->decimal('shipping_charge', 13, 2)->default(0);
            $table->decimal('packing_charge', 13, 2)->default(0);
            $table->decimal('total_order_amount', 13, 2)->default(0);

            $table->text('notes')->nullable();
            $table->text('terms')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['store_id', 'delivery_challan_reference', 'bill_to', 'bill_to_id', 'status'], 'delivery_challan_indexes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_challans');
    }
}