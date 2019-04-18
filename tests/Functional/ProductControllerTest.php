<?php


use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Store;
use Illuminate\Support\Carbon;
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
        $product = $this->mockProduct();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->jsonAuthorized('GET', route('api.product.show', ['id' => $product->id]));
        $response->assertStatus(200)->assertJson([
            'product' => $product->toArray()
        ]);
    }



    /**
     * @test
     */
    public function customerSearch()
    {
        $lessPrice = 50;
        $priceMedian = 100;
        $greaterPrice = 150;
        $lessPriceProduct = $this->mockProduct([
            'price' => $lessPrice,
            'created_at' => Carbon::now()->subDays(3),
        ]);
        $greaterPriceProduct = $this->mockProduct(['price' => $greaterPrice]);
        //Test price less than filter
        $response = $this->jsonAuthorized('GET', route('api.product.search'), ['fplt' => $priceMedian]);
        $response->assertStatus(200)
            ->assertJson([
                'products' => [$lessPriceProduct->toArray()]
            ]);
        //Test price greater than
        $response = $this->jsonAuthorized('GET', route('api.product.search'), ['fpgt' => $priceMedian]);
        $response->assertStatus(200)
            ->assertJson([
                'products' => [$greaterPriceProduct->toArray()]
            ]);
        //Test days from adding less than
        $response = $this->jsonAuthorized('GET', route('api.product.search'), ['ffcd' => 2]);
        $response->assertStatus(200)
            ->assertJson([
                'products' => [$greaterPriceProduct->toArray()]
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