<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeeToOutcome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outcome', function (Blueprint $table) {
            $table->decimal('fee', 3)->default(0);
            $table->decimal('net_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outcome', function (Blueprint $table) {
            $table->dropColumn('fee');
            $table->dropColumn('net_amount');
        });
    }
}
