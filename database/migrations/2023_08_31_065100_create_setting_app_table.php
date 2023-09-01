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
        Schema::create('setting_app', function (Blueprint $table) {
            $table->string('company_name', 250);
            $table->string('app_title', 250)->nullable()->index();
            $table->string('timezone', 100)->default('UTC');
            $table->string('app_date_time_format', 50);
            $table->string('app_date_format', 50);
            $table->text('invoice_print_logo')->nullable();
            $table->text('company_logo')->nullable();
            $table->text('navbar_logo')->nullable();
            $table->text('favicon')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index(['company_name', 'app_date_format']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_app');
    }
};
