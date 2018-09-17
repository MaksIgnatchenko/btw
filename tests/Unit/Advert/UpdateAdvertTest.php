<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */

namespace Tests\Unit\Categories;

use App\Modules\Advert\Requests\Admin\UpdateAdvertRequest;
use Tests\TestCase;

class UpdateAdvertTest extends TestCase
{
    public function testFillFieldsCorrect()
    {
        $data = [
            'name'   => 'sdfasdfasdf',
            'link'   => 'http://google.com',
            'status' => 'active'
        ];
        $rules = (new UpdateAdvertRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);

        $this->assertTrue($validator->passes());
    }

    public function testFillFieldsIncorrect()
    {
        $longString = str_random(501);
        $data = [
            'name'   => $longString,
            'link'   => 'wrong',
            'status' => 'wrong'
        ];
        $rules = (new UpdateAdvertRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);

        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals('The name may not be greater than 100 characters.', $errors->get('name')[0]);
        $this->assertEquals('The link format is invalid.', $errors->get('link')[0]);
        $this->assertEquals('The selected status is invalid.', $errors->get('status')[0]);
    }

    public function testEmptyFields()
    {
        $data = [
        ];
        $rules = (new UpdateAdvertRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);

        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals('The name field is required.', $errors->get('name')[0]);
        $this->assertEquals('The link field is required.', $errors->get('link')[0]);
        $this->assertEquals('The status field is required.', $errors->get('status')[0]);
    }
}
