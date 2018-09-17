<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeclinedWishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declined_wishes', function (Blueprint $table) {
            $table->integer('wish_id')->unsigned(true);
            $table->integer('merchant_id')->unsigned(true);

            $table->primary(['wish_id', 'merchant_id']);

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
        Schema::table('declined_wishes', function (Blueprint $table) {
            $table->dropForeign('declined_wishes_wish_id_foreign');
            $table->dropForeign('declined_wishes_merchant_id_foreign');
        });

        Schema::drop('declined_wishes');
    }
}
