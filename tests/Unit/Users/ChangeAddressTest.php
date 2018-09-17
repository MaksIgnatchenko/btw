<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 14.12.2017
 */

namespace Tests\Unit\Users;

use App\Modules\Users\Requests\Api\Address\UpdateCustomerAddressRequest;
use App\Modules\Users\Requests\Api\Address\UpdateCustomerDeliveryAddressRequest;
use Tests\TestCase;

class ChangeAddressTest extends TestCase
{
    public function testUpdateAddressCorrect()
    {
        $data = [
            'address'   => 'my address',
            'longitude' => 50.1111,
            'latitude'  => 30.123456,
        ];
        $rules = (new UpdateCustomerAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testUpdateAddressEmptyFields()
    {
        $data = [
        ];
        $rules = (new UpdateCustomerAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('address')[0], 'The address field is required.');
        $this->assertEquals($errors->get('longitude')[0], 'The longitude field is required.');
        $this->assertEquals($errors->get('latitude')[0], 'The latitude field is required.');
    }


    public function testUpdateDeliveryAddressEmptyFields()
    {
        $data = [
        ];
        $rules = (new UpdateCustomerDeliveryAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('address')[0], 'The address field is required.');
        $this->assertEquals($errors->get('longitude')[0], 'The longitude field is required.');
        $this->assertEquals($errors->get('latitude')[0], 'The latitude field is required.');
    }


    public function testUpdateDeliveryAddressCorrectFields()
    {
        $data = [
            'address'   => 'my address',
            'longitude' => 50.1111,
            'latitude'  => 30.123456,
        ];
        $rules = (new UpdateCustomerDeliveryAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }
}
