<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPushData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_merchant', function (Blueprint $table) {

            $table->integer('merchant_id')->unsigned(true);
            $table->boolean('enabled')->default(false);
            $table->boolean('review')->default(false);
            $table->boolean('wish_list')->default(false);
            $table->boolean('new_transaction')->default(false);

            $table->primary('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants');

            $table->timestamps();
        });

        Schema::create('push_customer', function (Blueprint $table) {

            $table->integer('customer_id')->unsigned(true);
            $table->boolean('enabled')->default(false);
            $table->boolean('new_posted_deal')->default(false);
            $table->boolean('new_price_breaker')->default(false);
            $table->boolean('redemption_reminder')->default(false);

            $table->primary('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->timestamps();
        });

        Schema::create('push_customer_categories', function (Blueprint $table) {

            $table->integer('push_customer_id')->unsigned(true);
            $table->integer('category_id')->unsigned(true);
            $table->primary(['category_id', 'push_customer_id']);

            $table->foreign('push_customer_id')->references('customer_id')->on('push_customer');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::table('push_customer_categories', function (Blueprint $table) {
            $table->dropForeign('push_customer_categories_push_customer_id_foreign');
            $table->dropForeign('push_customer_categories_category_id_foreign');
        });
        Schema::drop('push_customer_categories');

        Schema::table('push_customer', function (Blueprint $table) {
            $table->dropForeign('push_customer_customer_id_foreign');
        });
        Schema::drop('push_customer');

        Schema::table('push_merchant', function (Blueprint $table) {
            $table->dropForeign('push_merchant_merchant_id_foreign');
        });
        Schema::drop('push_merchant');
    }
}
