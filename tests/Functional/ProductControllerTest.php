<?php


use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Store;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

class ProductControllerTest extends TestCase
{


    /**
     * @test
     */
    public function show()
    {
        $customer = factory(Customer::class)->create();
        $authToken = auth()->guard('customer')->login($customer);
        $product = $this->mockProduct();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->get( route('api.product.show', ['id' => $product->id]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authToken,
        ]);
        $response->assertStatus(200)->assertJson([
            'product' => $product->toArray()
        ]);
    }

    /**
     * @param array $attr
     * @return Product
     */
    public function mockProduct(array $attr = [])
    {
        $merchant = factory(Merchant::class)->create();

        $store = factory(Store::class)->create([
            'merchant_id' => $merchant->id,
        ]);
        $category = factory(Category::class)->create();

        $attr = array_merge($attr, [
            'store_id' => $store->id,
            'category_id' => $category->id,
        ]);
        return factory(Product::class)->create($attr);
    }

    
}