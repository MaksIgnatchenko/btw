<?php

use App\Modules\Users\Enums\PaymentOptionsEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdditionalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('delivery_address');
            $table->string('country');
            $table->string('zip_code');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('business_name');
            $table->string('address');
            $table->string('country');
            $table->string('zip_code');
            $table->string('telephone');
            $table->string('ein');
            $table->string('contact');
            $table->enum('payment_option', PaymentOptionsEnum::getValues());
            $table->boolean('check');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('paypal', function (Blueprint $table) {
            $table->integer('merchant_id')->unsigned();
            $table->string('email');
            $table->string('application_security');
            $table->string('application_id');
            $table->timestamps();

            $table->primary('merchant_id');

            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade');
        });

        Schema::create('wire', function (Blueprint $table) {
            $table->integer('merchant_id')->unsigned();
            $table->string('bank_name');
            $table->string('aba_number');
            $table->string('account_name');
            $table->integer('account_number');
            $table->timestamps();

            $table->primary('merchant_id');

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
        Schema::table('paypal', function ($table) {
            $table->dropForeign('paypal_merchant_id_foreign');
        });
        Schema::table('wire', function ($table) {
            $table->dropForeign('wire_merchant_id_foreign');
        });
        Schema::table('merchants', function ($table) {
            $table->dropForeign('merchants_user_id_foreign');
        });
        Schema::table('customers', function ($table) {
            $table->dropForeign('customers_user_id_foreign');
        });

        Schema::dropIfExists('customers');
        Schema::dropIfExists('merchants');
        Schema::dropIfExists('paypal');
        Schema::dropIfExists('wire');
    }
}
