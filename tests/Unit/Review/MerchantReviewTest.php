<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace Tests\Unit\Products;

use App\Modules\Review\Requests\Api\CreateMerchantReviewRequest;
use Tests\TestCase;

class MerchantReviewTest extends TestCase
{
    public function testWithoutData()
    {
        $data = [
        ];
        $rules = (new CreateMerchantReviewRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('review')[0], 'The review field is required.');
        $this->assertEquals($errors->get('rate')[0], 'The rate field is required.');
        $this->assertEquals($errors->get('order_id')[0], 'The order id field is required.');
    }

    public function testIncorrectRate()
    {
        $data = [
            'rate' => 10
        ];
        $rules = (new CreateMerchantReviewRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('rate')[0], 'The rate must be between 1 and 5.');
    }

    public function testIncorrectReviewLength()
    {

        $data = [
            'review' => str_random(501)
        ];
        $rules = (new CreateMerchantReviewRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('review')[0], 'The review may not be greater than 500 characters.');
    }
}
