<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEnumTypeInReviewsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_reviews', function (Blueprint $table) {
            $table->string('status')->change();
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_reviews', function (Blueprint $table) {
            $table->enum('status', ['inactive', 'active'])->change();
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->string('status', ['inactive', 'active'])->change();
        });
    }
}
