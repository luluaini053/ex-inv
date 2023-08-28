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
        Schema::table('inv_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('depart_id')->nullable(false);
            $table->foreign('depart_id')->references('id')->on('departs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_logs', function (Blueprint $table) {
            $table->dropForeign('inv_logs_depart_id_foreign');
            $table->dropColumn('depart_id');
        });
    }
};
