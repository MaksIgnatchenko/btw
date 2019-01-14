<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->unsignedInteger('customer_id');
            $table->string('country');
            $table->string('street');
            // TODO !!
            $table->string('-Apt., Suite, Unit (optional);');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('notes');



            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_address');
    }
}
