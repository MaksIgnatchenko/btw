<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteBrokenProductsWithoutMerchant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $brokenProducts = DB::table('products')->where('store_id', null)->get()->pluck('id');

        DB::table('wishlists')->whereIn('product_id', $brokenProducts)->delete();

        DB::table('carts')->whereIn('product_id', $brokenProducts)->delete();

        DB::table('products')->where('store_id', null)->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
