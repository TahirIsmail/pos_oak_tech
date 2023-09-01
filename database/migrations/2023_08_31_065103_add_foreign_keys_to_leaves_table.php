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
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign(['leave_type_id'])->references(['id'])->on('leave_types')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['line_manager'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['staff_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign('leaves_leave_type_id_foreign');
            $table->dropForeign('leaves_line_manager_foreign');
            $table->dropForeign('leaves_staff_id_foreign');
        });
    }
};
