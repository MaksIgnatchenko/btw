<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace Tests\Unit\Products;

use App\Modules\Products\Dto\CustomerSearchDto;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Requests\Api\CustomerSearchRequest;
use App\Modules\Users\Repositories\MerchantRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class CustomerSearchTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testWithoutData()
    {
        $data = [
        ];
        $rules = (new CustomerSearchRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());


        $errors = $validator->errors();

        $this->assertEmpty($errors->get('barcode'));
    }

    public function testWithWrongData()
    {
        $data = [
            'barcode' => 'wrong wrong wrong wrong',
        ];
        $rules = (new CustomerSearchRequest())->rules();

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals($errors->get('barcode')[0], 'The barcode may not be greater than 20 characters.');
    }

    public function testNoMerchantsInRadius()
    {
        $mockMerchantRepo = Mockery::mock(MerchantRepository::class);
        $mockMerchantRepo->shouldReceive('getInRadius')->andReturn(new Collection());
        App::instance(MerchantRepository::class, $mockMerchantRepo);

        $productModel = new Product();
        $customerSearchDto = (new CustomerSearchDto())->setDistance(10)
            ->setKeyword('hello')
            ->setOffset(0)
            ->setLatitude(50)
            ->setLongitude(50);

        $result = $productModel->customerSearch($customerSearchDto);

        $this->assertNull($result);
    }

    public function testGetWithoutCategory()
    {
        $mockMerchantRepo = Mockery::mock(MerchantRepository::class);

        $product1 = new Product();
        $product1->name = 'name 1';
        $product1->user_id = 1;

        $product2 = new Product();
        $product2->name = 'name 2';
        $product2->user_id = 2;

        $products = [$product1, $product2];

        $mockMerchantRepo->shouldReceive('getInRadius')->andReturn(new Collection($products));
        App::instance(MerchantRepository::class, $mockMerchantRepo);
        $mockMerchantRepo->shouldReceive('getProductsByConditions')->andReturn(new Collection($products));
        App::instance(ProductRepository::class, $mockMerchantRepo);

        $productModel = new Product();
        $customerSearchDto = (new CustomerSearchDto())->setDistance(10)
            ->setKeyword('hello')
            ->setOffset(0)
            ->setLatitude(50)
            ->setLongitude(50);

        $result = $productModel->customerSearch($customerSearchDto);
        $this->assertInstanceOf(Product::class, $result->first());
        $this->assertEquals($result->first()->name, 'name 1');
    }

}