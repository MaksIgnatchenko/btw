<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerchantReviewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->text('review');
            $table->string('status');
            $table->tinyInteger('rate');

            $table->integer('customer_id')->unsigned();
            $table->integer('merchant_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('merchant_id')->references('id')->on('merchants');

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
        Schema::drop('merchant_reviews');
    }
}
