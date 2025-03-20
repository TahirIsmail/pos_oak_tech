<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePattyCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patty_cashes', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->year('year');
            $table->string('month');
            $table->timestamps();

            $table->unique(['month', 'year'], 'month_year_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patty_cashes');
    }
}
