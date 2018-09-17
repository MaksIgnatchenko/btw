<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.12.2017
 */

namespace Tests\Unit\Products;

use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Requests\Api\GetProductsRequest;
use Tests\TestCase;

class GetProductsValidationTest extends TestCase
{
    public function testFillFieldsCorrect()
    {
        $data = [
            'filter' => ProductFiltersEnum::OUTSTANDING_OFFERS,
            'offset' => 0,
        ];
        $rules = (new GetProductsRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());

        $data = [
            'filter' => ProductFiltersEnum::EXPIRED_OFF,
            'offset' => 0,
        ];
        $rules = (new GetProductsRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testFillFieldsIncorrect()
    {
        $data = [
            'filter' => 'Wrong',
            'offset' => 'Wrong',
        ];
        $rules = (new GetProductsRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEquals($errors->get('filter')[0], 'The selected filter is invalid.');
        $this->assertEquals($errors->get('offset')[0], 'The offset must be an integer.');
    }
}