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
        Schema::table('supplier_performances', function (Blueprint $table) {
            $table->foreign(['store_id'])->references(['id'])->on('stores')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['supplier_id'])->references(['id'])->on('suppliers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_performances', function (Blueprint $table) {
            $table->dropForeign('supplier_performances_store_id_foreign');
            $table->dropForeign('supplier_performances_supplier_id_foreign');
        });
    }
};
