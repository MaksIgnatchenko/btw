<?php

use Illuminate\Database\Seeder;

class GeographyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/Countries-States-Cities-database/';

        DB::statement(file_get_contents($path . 'countries.sql'));

        DB::statement(file_get_contents($path . 'states.sql'));

        DB::statement(file_get_contents($path . 'cities.sql'));
    }
}
