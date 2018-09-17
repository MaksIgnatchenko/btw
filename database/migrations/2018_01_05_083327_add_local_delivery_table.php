<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocalDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_local_delivery', function (Blueprint $table) {
            $table->increments('id');

            $table->string('distance');
            $table->boolean('active');

            $table->integer('product_id')->unsigned()->unique();
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('store_delivery')->default(false);
            $table->dropColumn('delivery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_local_delivery');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('store_delivery');
            $table->string('delivery')->default('local');
        });
    }
}
