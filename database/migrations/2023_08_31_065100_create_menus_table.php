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
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30);
            $table->string('menu_key', 50)->unique();
            $table->string('label', 100);
            $table->string('route', 200)->nullable();
            $table->integer('parent')->default(0);
            $table->integer('sort_order')->nullable();
            $table->string('icon', 200)->nullable();
            $table->tinyInteger('is_restaurant_menu')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index(['type', 'menu_key', 'parent', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
