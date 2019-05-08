<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 23.04.2019
 */

namespace Tests\Functional\Customer;


use Tests\TestCase;

class RecentlyViewedControllerTest extends TestCase
{

    public function testGet()
    {
        $product = $this->mockProducts()[0];

        $this->viewProduct($product);
        $getRecentlyViewed = $this->jsonAuthorized(
            'GET',
            route('api.customer.recently-viewed.list')
        );

        $this->assertDatabaseHas(
            'recently_viewed_products',
            [
                'customer_id' => $this->authCustomer->id,
                'product_id' => $product->id
            ]);
        $getRecentlyViewed->assertStatus(200)
            ->assertJson(['products' => [$product->toArray()]]);

    }

    public function testRemove()
    {
        $product = $this->mockProducts()[0];

        $this->viewProduct($product);

        $this->assertDatabaseHas(
            'recently_viewed_products',
            [
                'customer_id' => $this->authCustomer->id,
                'product_id' => $product->id
            ]);

        $response = $this->jsonAuthorized(
            'DELETE',
            route('api.customer.recently-viewed.remove', ['product' => $product->id])
        );

        $this->assertDatabaseMissing(
            'recently_viewed_products',
            [
                'customer_id' => $this->authCustomer->id,
                'product_id' => $product->id
            ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
    }


    public function testClear()
    {
        $product = $this->mockProducts()[0];

        $this->viewProduct($product);

        $this->assertDatabaseHas(
            'recently_viewed_products',
            [
                'customer_id' => $this->authCustomer->id,
                'product_id' => $product->id
            ]);

        $response = $this->jsonAuthorized(
            'DELETE',
            route('api.customer.recently-viewed.clear')
        );

        $this->assertDatabaseMissing(
            'recently_viewed_products',
            [
                'customer_id' => $this->authCustomer->id,
                'product_id' => $product->id
            ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
    }

    protected function viewProduct($product){
       $this->jsonAuthorized(
            'GET',
            route('api.products.show', ['id' => $product->id])
        );
    }
}