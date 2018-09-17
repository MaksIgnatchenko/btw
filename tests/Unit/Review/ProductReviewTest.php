<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace Tests\Unit\Products;

use App\Modules\Review\Requests\Api\CreateProductReviewRequest;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    public function testWithoutData()
    {
        $data = [
        ];
        $rules = (new CreateProductReviewRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('review')[0], 'The review field is required.');
        $this->assertEquals($errors->get('order_id')[0], 'The order id field is required.');
    }

    public function testIncorrectReviewLength()
    {
        $data = [
            'review' => str_random(501)
        ];
        $rules = (new CreateProductReviewRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('review')[0], 'The review may not be greater than 500 characters.');
    }
}
