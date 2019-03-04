<?php

use Illuminate\Database\Seeder;
use \App\Modules\Categories\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category2 = new Category();
        $category2->id = 2;
        $category2->name = 'Activities';
        $category2->parent_category_id = null;
        $category2->is_final = false;
        $category2->save();

        $category3 = new Category();
        $category3->id = 3;
        $category3->name = 'Bar';
        $category3->parent_category_id = null;
        $category3->is_final = false;
        $category3->save();
        // ========================

        // shop children
        $category4 = new Category();
        $category4->id = 4;
        $category4->name = 'Electronics';
        $category4->parent_category_id = 1;
        $category4->is_final = false;

        $category4->save();

        $category5 = new Category();
        $category5->id = 5;
        $category5->name = 'Health & Beauty';
        $category5->parent_category_id = 1;
        $category5->is_final = false;

        $category5->save();

        // electronics children
        $category6 = new Category();
        $category6->id = 6;
        $category6->name = 'Camera';
        $category6->parent_category_id = 4;
        $category6->is_final = true;

        $category6->save();


        $category7 = new Category();
        $category7->id = 7;
        $category7->name = 'Phones';
        $category7->parent_category_id = 4;
        $category7->is_final = true;
        $category7->save();

        // Health & Beauty children
        $category8 = new Category();
        $category8->id = 8;
        $category8->name = 'Skin care';
        $category8->parent_category_id = 5;
        $category8->is_final = true;
        $category8->save();


        $category9 = new Category();
        $category9->id = 9;
        $category9->name = 'Salon & spa';
        $category9->parent_category_id = 5;
        $category9->is_final = true;
        $category9->save();

        // Activities children
        $category10 = new Category();
        $category10->id = 10;
        $category10->name = 'Sightseeing & Tours';
        $category10->parent_category_id = 2;
        $category10->is_final = true;
        $category10->save();

        // Bar children
        $category11 = new Category();
        $category11->id = 11;
        $category11->name = 'Coffee & Deserts';
        $category11->parent_category_id = 3;
        $category11->is_final = false;
        $category11->save();

        // Coffee & deserts children
        $category12 = new Category();
        $category12->id = 12;
        $category12->name = 'Price Breaker';
        $category12->parent_category_id = 11;
        $category12->is_final = true;
        $category12->save();
    }
}
