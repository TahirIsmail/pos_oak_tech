<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->enum('customer_type', ['DEFAULT', 'CUSTOM', 'WALKIN']);
            $table->string('name', 250);
            $table->string('email', 150)->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('father_name', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('cnic', 255)->nullable();
            $table->string('dob', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['email', 'phone', 'status']);
        });

        Artisan::call('db:seed', [
            '--class' => customer_table_seeder::class,
            '--force' => true
        ]);
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
}
