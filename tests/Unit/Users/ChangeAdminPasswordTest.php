<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 19.12.2017
 */

namespace Tests\Unit\Users;

use App\Modules\Users\Http\Requests\Admin\ChangeAdminPasswordRequest;
use Tests\TestCase;

class ChnageAdminPassword extends TestCase
{
    public function testCorrectValidation()
    {
        $data = [
            'password'              => 'administrator1!',
            'password_confirmation' => 'administrator1!',

        ];
        $rules = (new ChangeAdminPasswordRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testWrongValidation()
    {
        $data = [
        ];
        $rules = (new ChangeAdminPasswordRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('password')[0], 'The password field is required.');

        $data = [
            'password' => 'administrator1!',
        ];
        $rules = (new ChangeAdminPasswordRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('password')[0], 'The password confirmation does not match.');

        $data = [
            'password'              => 'administrator1!',
            'password_confirmation' => '123fsdg',
        ];
        $rules = (new ChangeAdminPasswordRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('password')[0], 'The password confirmation does not match.');
    }
}
