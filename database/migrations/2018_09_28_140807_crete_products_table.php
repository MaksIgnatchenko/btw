<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->unsignedInteger('category_id');
            $table->json('attributes')->nullable(true);
            $table->json('parameters')->nullable(true);

            $table->decimal('regular_price');
            $table->decimal('offer_price');
            $table->unsignedTinyInteger('tax');

            $table->string('main_image');


            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->timestamps();

            $table->string('barcode')->nullable(true);
            $table->timestamp('offer_end')->useCurrent();
            $table->unsignedInteger('user_id');

            $table->boolean('certificate');
            $table->string('return_details')->nullable(true);
            $table->integer('purchase_count')->default(0);
            $table->decimal('rating')->default(0.0);

            $table->boolean('store_delivery')->default(false);
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('image');

            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::table('product_images', function ($table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('products', function ($table) {
            $table->dropForeign(['category_id']);
        });
        Schema::drop('product_images');
        Schema::drop('products');
    }

}
