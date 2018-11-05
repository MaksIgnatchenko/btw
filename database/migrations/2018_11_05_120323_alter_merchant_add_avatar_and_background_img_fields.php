<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMerchantAddAvatarAndBackgroundImgFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('background_img')->nullable();
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
            $table->dropColumn('avatar');
            $table->dropColumn('background_img');
        });
    }
}
