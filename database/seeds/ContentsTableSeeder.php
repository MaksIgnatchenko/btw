<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */

use App\Modules\Content\Models\Content;
use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        $content = new Content();
        $content->key = 'terms-customer';
        $content->title = 'Terms & Conditions customer';
        $content->value = 'Come terms text';
        $content->save();

        $content = new Content();
        $content->key = 'terms-merchant';
        $content->title = 'Terms & Conditions merchant';
        $content->value = 'Come privacy text';
        $content->save();
    }
}
