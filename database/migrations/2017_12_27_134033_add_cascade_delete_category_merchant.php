<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeDeleteCategoryMerchant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_merchant', function (Blueprint $table) {
            $table->dropForeign('category_merchant_category_id_foreign');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_merchant', function (Blueprint $table) {
            $table->dropForeign('category_merchant_category_id_foreign');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }
}
