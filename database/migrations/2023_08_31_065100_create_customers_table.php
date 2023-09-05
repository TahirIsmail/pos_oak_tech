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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->enum('customer_type', ['DEFAULT', 'CUSTOM', 'WALKIN']);
            $table->string('password', 100);
            $table->string('init_password', 10)->nullable();
            $table->string('name', 250);
            $table->string('email', 150)->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['email', 'phone', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
