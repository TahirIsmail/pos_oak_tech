<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->string('expense_name',255);
            $table->unsignedBigInteger('expense_category');
            $table->string('amount');
            $table->unsignedInteger('status');
            $table->string('receipt_upload')->nullable();
            $table->date('expense_date')->nullable();
            $table->mediumText('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('expense_category')->references('id')->on('master_expense_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->index('status');
            
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
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['expense_category']);
        });
        
        Schema::dropIfExists('expenses');
    }
}
