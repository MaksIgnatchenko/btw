<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.12.2017
 */

namespace Tests\Unit\Orders;

use App\Modules\Order\Enums\OrderMerchantFilterEnum;
use App\Modules\Orders\Enums\OrderFilterEnum;
use App\Modules\Orders\Requests\GetOrdersRequest;
use App\Modules\Products\Requests\Api\GetProductsRequest;
use Tests\TestCase;

class GetOrdersValidationTest extends TestCase
{
    public function testFillFieldsCustomerCorrect()
    {
        $data = [
            'filter' => OrderFilterEnum::REFUNDED,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());

        $data = [
            'filter' => OrderFilterEnum::REDEEMED,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());

        $data = [
            'filter' => OrderFilterEnum::UNREDEEMED,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testFillFieldsMerchantCorrect()
    {
        $data = [
            'filter' => OrderMerchantFilterEnum::PENDING_REDEMPTION,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());

        $data = [
            'filter' => OrderMerchantFilterEnum::PENDING_PAYOUT,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());

        $data = [
            'filter' => OrderMerchantFilterEnum::COMPLETED_TRANSACTIONS,
            'offset' => 0,
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testFillFieldsIncorrect()
    {
        $data = [
            'filter' => 'Wrong',
            'offset' => 'Wrong',
        ];
        $rules = (new GetOrdersRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals('The selected filter is invalid.', $errors->get('filter')[0]);
        $this->assertEquals('The offset must be a number.', $errors->get('offset')[0]);
    }
}
