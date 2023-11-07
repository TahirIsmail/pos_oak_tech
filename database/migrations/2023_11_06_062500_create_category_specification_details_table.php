<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorySpecificationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_specification_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('child_category_id');
            $table->unsignedBigInteger('category_specification_id');
            $table->string('values');
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
        Schema::dropIfExists('category_specification_details');
    }
}
