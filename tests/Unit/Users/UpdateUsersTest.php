<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace Tests\Unit\Users;

use App\Modules\Users\Requests\Api\Address\UpdateMerchantAddressRequest;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{
    public function testSetCorrectData()
    {
        $data = [
            'longitude' => 57.12345678,
            'latitude'  => -40.1238954234,
            'address'   => 'qweasd',
        ];
        $rules = (new UpdateMerchantAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testSetWrongData()
    {
        $data = [
            'longitude' => 'Wrong',
            'latitude'  => -0,
        ];
        $rules = (new UpdateMerchantAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('longitude')[0], 'The longitude must be a number.');
        $this->assertEmpty($errors->get('latitude'));
    }

    public function testSetEmptyData()
    {
        $data = [
        ];
        $rules = (new UpdateMerchantAddressRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('longitude')[0], 'The longitude field is required.');
        $this->assertEquals($errors->get('latitude')[0], 'The latitude field is required.');
    }
}
