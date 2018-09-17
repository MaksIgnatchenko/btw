<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOutcome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('amount');
            $table->string('payment_type');
            $table->integer('merchant_id')->unsigned();
            $table->timestamp('payment_date');

            $table->foreign('merchant_id')->references('id')->on('merchants');

            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('outcome_id')->unsigned()->nullable(true);

            $table->foreign('outcome_id')->references('id')->on('outcome');
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
            $table->dropForeign('orders_outcome_id_foreign');
            $table->dropColumn('outcome_id');
        });
        Schema::drop('outcome');
    }
}
