<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->string('user_code', 30)->unique();
            $table->string('fullname', 250);
            $table->string('father_name', 250)->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('cnic', 255)->nullable();

            $table->string('email', 150)->unique();
            $table->string('password', 100);
            $table->string('init_password', 10)->nullable();
            $table->text('password_reset_token')->nullable();
            $table->integer('password_reset_max_tries')->default(0);
            $table->dateTime('password_reset_last_tried_on')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();

            $table->string('bank_name', 255)->nullable();
            $table->string('bank_code', 255)->nullable();
            $table->string('account_title', 255)->nullable();
            $table->string('account_number', 255)->nullable();
            $table->string('iban_number', 255)->nullable();

            $table->text('profile_image')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('supplier_id');
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status']);
        });

        Artisan::call('db:seed', [
            '--class' => users_table_seeder::class,
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
        Schema::dropIfExists('users');
    }
}
