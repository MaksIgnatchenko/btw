<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace Tests\Unit\Products;

use App\Modules\Products\Requests\Api\SetProductRequest;
use App\Modules\Products\Requests\Api\UpdateProductRequest;
use Tests\TestCase;

class UpdateProductValidationTest extends TestCase
{

    public function testEmptyFields()
    {
        $data = [
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('certificate')[0], 'The certificate field is required.');
        $this->assertEmpty($errors->get('barcode'));
        $this->assertEquals($errors->get('return_details')[0], 'The return details field is required.');
    }

    public function testFillFields()
    {
        // TODO придумать как лучше валидатор вызывать
        $data = [
            'name'           => 'Some name',
            'description'    => 'Some description',
            'regular_price'  => 0.99,
            'offer_price'    => 0.99,
            'tax'            => 100,
            'offer_end'      => time(),
            'return_details' => 'In 1 day'
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('category_id')[0], 'The category id field is required.');
        $this->assertEquals($errors->get('main_image')[0], 'The main image field is required.');

        $this->assertEmpty($errors->get('images'));
        $this->assertEmpty($errors->get('name'));
        $this->assertEmpty($errors->get('description'));
        $this->assertEmpty($errors->get('regular_price'));
        $this->assertEmpty($errors->get('offer_price'));
        $this->assertEmpty($errors->get('tax'));
        $this->assertEmpty($errors->get('barcode'));
        $this->assertEmpty($errors->get('offer_end'));
        $this->assertEmpty($errors->get('return_details'));
    }

    public function testTooMuchPictures()
    {
        $data = [
            'images' => [1, 2, 3, 4, 5, 6, 7],
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('images')[0], 'The images may not have more than 5 items.');
    }

    public function testDelivery()
    {
        $data = [
            'delivery' => 'some text',
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEmpty($errors->get('delivery'));
    }

    // TODO would be fixed when local delivery distance would be added
    public function testLocalDeliveryAndNoDistance()
    {
        $data = [
            'local_delivery' => true,
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('local_delivery_distance')[0], 'The local delivery distance field is required when local delivery is 1.');
    }

    public function testLocalDeliveryCorrect()
    {
        $data = [
            'local_delivery' => true,
            'local_delivery_distance' => '999',
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEmpty($errors->get('local_delivery'));
        $this->assertEmpty($errors->get('local_delivery_distance'));
    }

    public function testStoreDeliveryCorrect()
    {
        $data = [
            'store_delivery' => true,
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEmpty($errors->get('store_delivery'));
        $this->assertEquals($errors->get('local_delivery')[0], 'The local delivery field is required.');
        $this->assertEmpty($errors->get('local_delivery_distance'));
    }

    public function testBarcode()
    {
        $data = [
            'barcode' => '1234567891234',
        ];
        $rules = (new UpdateProductRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEmpty($errors->get('barcode'));
    }
}
