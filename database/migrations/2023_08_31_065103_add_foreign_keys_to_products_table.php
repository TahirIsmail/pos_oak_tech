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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['discount_code_id'])->references(['id'])->on('discount_codes')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['sub_category_id'])->references(['id'])->on('sub_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['tax_code_id'])->references(['id'])->on('tax_codes')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['updated_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_created_by_foreign');
            $table->dropForeign('products_discount_code_id_foreign');
            $table->dropForeign('products_sub_category_id_foreign');
            $table->dropForeign('products_tax_code_id_foreign');
            $table->dropForeign('products_updated_by_foreign');
        });
    }
};
