<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */

namespace Tests\Unit\Categories;

use App\Modules\Categories\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    public function testSortCategories()
    {
        // root categories
        $category1 = new Category();
        $category1->id = 1;
        $category1->name = 'Shop';
        $category1->parent_category_id = 0;

        $category2 = new Category();
        $category2->id = 2;
        $category2->name = 'Activities';
        $category2->parent_category_id = 0;

        $category3 = new Category();
        $category3->id = 3;
        $category3->name = 'Bar';
        $category3->parent_category_id = 0;
        // ========================

        // shop children
        $category4 = new Category();
        $category4->id = 4;
        $category4->name = 'Electronics';
        $category4->parent_category_id = 1;

        $category5 = new Category();
        $category5->id = 5;
        $category5->name = 'Health & Beauty';
        $category5->parent_category_id = 1;

        // electronics children
        $category6 = new Category();
        $category6->id = 6;
        $category6->name = 'Camera';
        $category6->parent_category_id = 4;

        $category7 = new Category();
        $category7->id = 7;
        $category7->name = 'Phones';
        $category7->parent_category_id = 4;

        // Health & Beauty children
        $category8 = new Category();
        $category8->id = 8;
        $category8->name = 'Skin care';
        $category8->parent_category_id = 5;

        $category9 = new Category();
        $category9->id = 9;
        $category9->name = 'Salon & spa';
        $category9->parent_category_id = 5;

        // Activities children
        $category10 = new Category();
        $category10->id = 10;
        $category10->name = 'Sightseeing & Tours';
        $category10->parent_category_id = 2;

        // Bar children
        $category11 = new Category();
        $category11->id = 11;
        $category11->name = 'Coffee & Deserts';
        $category11->parent_category_id = 3;

        // Coffee & deserts children
        $category12 = new Category();
        $category12->id = 12;
        $category12->name = 'Price Breaker';
        $category12->parent_category_id = 11;


        $categories = new Collection([
            $category1,
            $category2,
            $category3,
            $category4,
            $category5,
            $category6,
            $category7,
            $category8,
            $category9,
            $category10,
            $category11,
            $category12,
        ]);

        $categoryModel = new Category();
        $sortedCategories = $categoryModel->buildCategoriesTree($categories);

        $this->assertEquals($sortedCategories[0]->name, 'Shop');
        $this->assertEquals($sortedCategories[1]->name, 'Activities');
        $this->assertEquals($sortedCategories[2]->name, 'Bar');

        $this->assertEquals($sortedCategories[0]->children[0]->name, 'Electronics');
        $this->assertEquals($sortedCategories[0]->children[1]->name, 'Health & Beauty');

        $this->assertEquals($sortedCategories[0]->children[0]->children[0]->name, 'Camera');
        $this->assertEquals($sortedCategories[0]->children[0]->children[1]->name, 'Phones');

        $this->assertEquals($sortedCategories[0]->children[1]->children[0]->name, 'Skin care');
        $this->assertEquals($sortedCategories[0]->children[1]->children[1]->name, 'Salon & spa');


        $this->assertEquals($sortedCategories[1]->children[0]->name, 'Sightseeing & Tours');

        $this->assertEquals($sortedCategories[2]->children[0]->name, 'Coffee & Deserts');

        $this->assertEquals($sortedCategories[2]->children[0]->children[0]->name, 'Price Breaker');
    }
}
