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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slack', 30)->unique();
            $table->string('user_code', 30)->unique();
            $table->string('fullname', 250);
            $table->string('email', 150)->unique();
            $table->string('password', 100);
            $table->string('init_password', 10)->nullable();
            $table->text('password_reset_token')->nullable();
            $table->integer('password_reset_max_tries')->default(0);
            $table->dateTime('password_reset_last_tried_on')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('profile_image')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('language_id')->nullable()->index();
            $table->tinyInteger('status')->default(0)->index();
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
        Schema::dropIfExists('users');
    }
};
