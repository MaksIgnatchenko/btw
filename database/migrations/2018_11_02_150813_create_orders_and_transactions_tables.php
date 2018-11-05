<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersAndTransactionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function() {
            Schema::create('transactions', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('customer_id');

                $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');

                $table->json('cart');
                $table->text('message');
                $table->string('status');
                $table->decimal('amount');

                $table->timestamps();
            });

            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('customer_id');
                $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');

                $table->unsignedInteger('merchant_id');
                $table->foreign('merchant_id')
                    ->references('id')
                    ->on('merchants')
                    ->onDelete('cascade');

                $table->unsignedInteger('transaction_id');
                $table->foreign('transaction_id')
                    ->references('id')
                    ->on('transactions')
                    ->onDelete('cascade');

                $table->json('product');

                $table->integer('quantity');
                $table->enum('status', ['pending', 'picked_up', '__returned', '_refunded']);

                $table->timestamps();
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_customer_id_foreign');
            $table->dropForeign('orders_merchant_id_foreign');
            $table->dropForeign('orders_transaction_id_foreign');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_customer_id_foreign');
        });

        Schema::dropIfExists('orders');
        Schema::dropIfExists('transactions');
    }
}
