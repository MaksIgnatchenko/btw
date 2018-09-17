<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace Tests\Unit\Users;

use App\Modules\Users\Requests\Api\SetMerchantsCategoriesRequest;
use Tests\TestCase;

class MerchantCategoriesTest extends TestCase
{
    public function testSetEmptyData()
    {
        $data = [
        ];
        $rules = (new SetMerchantsCategoriesRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('categories')[0], 'The categories field is required.');
    }
}
