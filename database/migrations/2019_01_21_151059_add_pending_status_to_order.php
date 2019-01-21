<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPendingStatusToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE orders CHANGE status status ENUM('in_process', 'shipped', 'delivered','picked_up','closed', 'pending')");

        Schema::table('orders', function (Blueprint $table) {
            $table->unique('tracking_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE orders CHANGE status status ENUM('in_process', 'shipped', 'delivered','picked_up','closed')");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique('tracking_number');
        });
    }
}
