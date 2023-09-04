<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('slack', 30)->unique();
            $table->bigInteger('complaint_ref')->nullable();
            $table->string('complaint_status',255)->nullable();
           
            $table->mediumText('descriptions')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->unsignedInteger('complaint_by')->nullable();
            $table->unsignedInteger('store_id')->nullable();

            $table->foreignId('assigned_to')
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');
            $table->foreign('complaint_by')->references('id')->on('customers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('set null')->onUpdate('cascade');
            
            
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
        
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign('complaints_complaint_by_foreign');

            $table->dropForeign('complaints_assigned_to_foreign');

            // $table->dropForeign('complaints_store_id_foreign');
        });
        Schema::dropIfExists('complaints');
    }
}
