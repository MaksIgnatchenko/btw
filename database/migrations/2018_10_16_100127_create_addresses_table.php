<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 2);
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('zipcode', 10);

            $table->unsignedInteger('merchant_id')->nullable();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
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
        Schema::dropIfExists('addresses');
    }
}
