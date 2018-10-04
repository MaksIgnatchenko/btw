 <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->integer('parent_category_id')->unsigned()->nullable(true);
            $table->boolean('is_final')->default(false);
            $table->string('icon')->nullable(true);
            $table->json('attributes')->nullable(true);
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('parent_category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function ($table) {
            $table->dropForeign('categories_parent_category_id_foreign');
        });
        Schema::dropIfExists('categories');
    }

}
