<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('county');
        });


        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('delivery_address');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('county');
        });


        Schema::create('customer_address', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned();
            $table->text('address');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);

            $table->timestamps();

            $table->primary('customer_id');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });

        Schema::create('customer_delivery_address', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned();
            $table->text('address');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);

            $table->timestamps();

            $table->primary('customer_id');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
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
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('country')->default('');
            $table->string('zip_code')->default('');
            $table->string('city')->default('');
            $table->string('county')->default('');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->text('delivery_address');
            $table->string('address')->default('');
            $table->string('country')->default('');
            $table->string('zip_code')->default('');
            $table->string('city')->default('');
            $table->string('county')->default('');
        });

        Schema::table('customer_address', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('customer_address');

        Schema::table('customer_delivery_address', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('customer_delivery_address');
    }
}
