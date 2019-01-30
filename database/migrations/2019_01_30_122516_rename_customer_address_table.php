<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('customer_addresses', 'customer_delivery_information');

        Schema::table('customer_delivery_information', function (Blueprint $table) {
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('customer_delivery_information', 'customer_addresses');

        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
}
