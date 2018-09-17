<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 10.01.2018
 */

namespace Tests\Unit\Products;

use App\Modules\Products\Requests\Api\CreateTransactionRequest;
use App\Modules\Products\Requests\Api\UpdateTransactionRequest;
use Illuminate\Support\Str;
use Tests\TestCase;

class TransactionValidationTest extends TestCase
{
    public function testUpdateTransactionEmptyData()
    {
        $data = [
        ];
        $rules = (new UpdateTransactionRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('status')[0], 'The status field is required.');
    }

    public function testUpdateTransactionWrongData()
    {
        $data = [
            'status' => 'wrong',
        ];
        $rules = (new UpdateTransactionRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('status')[0], 'The selected status is invalid.');
    }

    public function testUpdateTransactionPendingStatus()
    {
        $data = [
            'status' => 'pending',
        ];
        $rules = (new UpdateTransactionRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('status')[0], 'The selected status is invalid.');
    }

    public function testUpdateTransactionCorrect()
    {
        $data = [
            'status' => 'fail',
            'message' => 'bla bla',
        ];
        $rules = (new UpdateTransactionRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function testUpdateTransactionTooLongMessage()
    {
        $message = Str::random(11000);
        $data = [
            'status' => 'fail',
            'message' => $message,
        ];
        $rules = (new UpdateTransactionRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('message')[0], 'The message may not be greater than 10000 characters.');
    }
}
