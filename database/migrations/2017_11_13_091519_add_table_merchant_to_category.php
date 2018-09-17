<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableMerchantToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_merchant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_merchant', function ($table) {
            $table->dropForeign('category_merchant_merchant_id_foreign');
        });
        Schema::table('category_merchant', function ($table) {
            $table->dropForeign('category_merchant_category_id_foreign');
        });
        Schema::dropIfExists('category_merchant');
    }
}
