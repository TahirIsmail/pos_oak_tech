<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseCategories extends Migration
{
    public function up()
    {
        Schema::create('master_expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->string('label',255)->nullable();
            $table->string('name',255)->nullable();
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
        Schema::dropIfExists('master_expense_categories');
    }
}
