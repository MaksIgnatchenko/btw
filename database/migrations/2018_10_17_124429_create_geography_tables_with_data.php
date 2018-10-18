<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;
use \App\Modules\Users\Merchant\Services\Geography\GeographyService;

class CreateGeographyTablesWithData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geography_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sortname', 2);
            $table->string('name');
            $table->integer('phoneCode');
        });

        Schema::create('geography_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('country_id');

            $table->foreign('country_id')
                ->references('id')
                ->on('geography_countries');
        });

        Schema::create('geography_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('state_id');

            $table->foreign('state_id')
                ->references('id')
                ->on('geography_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('geography_states', function (Blueprint $table) {
            $table->dropForeign('geography_states_country_id_foreign');
        });

        Schema::table('geography_cities', function (Blueprint $table) {
            $table->dropForeign('geography_cities_state_id_foreign');
        });

        Schema::dropIfExists('geography_countries');
        Schema::dropIfExists('geography_states');
        Schema::dropIfExists('geography_cities');
    }
}
