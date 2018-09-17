<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->integer('merchant_id')->unsigned();
            $table->string('transaction_id', 64);

            $table->json('product');
            $table->integer('quantity')->unsigned();
            $table->string('qr_code', 64);
            $table->string('status');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('merchant_id')->references('id')->on('customers');
            $table->foreign('transaction_id')->references('id')->on('transactions');

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
        Schema::drop('orders');
    }
}
