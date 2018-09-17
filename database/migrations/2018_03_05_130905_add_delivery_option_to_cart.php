<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryOptionToCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->string('delivery_option')->nullable(true);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_option')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('delivery_option');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_option');
        });
    }
}
