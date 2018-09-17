<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->increments('id');
            $table->json('product');
            $table->integer('category_id')->unsigned(true);
            $table->string('name');
            $table->decimal('longitude', 11, 8)->nullable(true);
            $table->decimal('latitude', 10, 8)->nullable(true);
            $table->integer('quantity')->unsigned(true);

            $table->decimal('desired_price');
            $table->decimal('max_price');
            $table->dateTime('end_date');

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wish_id')->unsigned(true);
            $table->integer('merchant_id')->unsigned(true);

            $table->decimal('price');
            $table->decimal('tax');

            $table->timestamps();

            $table->foreign('wish_id')->references('id')->on('wishes');
            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishes', function (Blueprint $table) {
            $table->dropForeign('wishes_category_id_foreign');
        });
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign('bids_wish_id_foreign');
            $table->dropForeign('bids_merchant_id_foreign');
        });
        Schema::drop('wishes');
        Schema::drop('bids');
    }
}
