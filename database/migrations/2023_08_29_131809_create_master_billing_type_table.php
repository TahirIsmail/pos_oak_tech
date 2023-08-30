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
        Schema::create('master_billing_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('billing_type_constant', 50)->unique();
            $table->string('label', 150);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('master_billing_type');
    }
};
