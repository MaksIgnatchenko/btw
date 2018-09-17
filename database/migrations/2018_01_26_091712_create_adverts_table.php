<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('link', 200);
            $table->string('image', 200);
            $table->string('status', 100);
            $table->bigInteger('counter', false, true)->default(0);
            $table->timestamps();
        });

        Schema::create('adverts_config', function (Blueprint $table) {
            $table->string('key');
            $table->string('value');

            $table->primary('key');

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
        Schema::drop('adverts');
        Schema::drop('adverts_config');
    }
}
