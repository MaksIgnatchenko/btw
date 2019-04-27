<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.04.2019
 */

namespace Tests\Functional;

use App\Modules\Products\Models\Cart;
use Tests\TestCase;

/**
 * Class CartControllerTest
 * @package Tests\Functional
 */
class CartControllerTest extends TestCase
{

    public function testCreatePositive()
    {
        $productId = $this->mockProducts()[0]->id;
        $quantity = 5;

        $response = $this->jsonAuthorized(
            'POST',
            route('api.carts.create'),
            [
                'product_id' => $productId,
                'quantity' => $quantity,
            ],[], $this->apiAuthToken());

        $this->assertDatabaseHas('carts', [
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id
        ]);

        $response->assertStatus(200)->assertJson(['success' => true]);
    }

    public function testCreateNegativeCartAlreadyCreated()
    {
        $productId = $this->mockProducts()[0]->id;
        $quantity = 5;
        $cart = factory(Cart::class)->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id,
        ]);
        $response = $this->jsonAuthorized(
            'POST',
            route('api.carts.create'),
            [
                'product_id' => $productId,
                'quantity' => $quantity,
            ],[], $this->apiAuthToken());

        $response->assertStatus(400)->assertJson([
                'message' => 'The given data is invalid',
                'errors' => [
                    'product_id' => 'This product is already added to cart',
                ],
            ]);
    }

    public function testCreateNegativeInvalidQuantity()
    {

        $quantity = 5;
        $productId = $this->mockProducts(['quantity' => $quantity - 1])[0]->id;
        $response = $this->jsonAuthorized(
            'POST',
            route('api.carts.create'),
            [
                'product_id' => $productId,
                'quantity' => $quantity,
            ],[], $this->apiAuthToken());
        $response->assertStatus(422)->assertJson([
                'message' => 'The given data is invalid',
                'errors' => [
                    'quantity' => 'Quantity must be a value between 1 and product quantity',
                ],
            ]);
    }

    public function testCheck()
    {
        $productId = $this->mockProducts()[0]->id;
        $quantity = 5;

        $cart = factory(Cart::class)->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id,
        ]);

        $response = $this->jsonAuthorized(
            'GET',
            route('api.carts.check'),
            [],[], $this->apiAuthToken());

        $response->assertStatus(200)->assertJson(['success' => true]);
    }

    /**
     * @dataProvider updateDataProvider
     * @param $productQuantity
     * @param $cartQuantity
     * @param $updateCartQuantity
     * @param $expected
     */
    public function testUpdate($productQuantity, $cartQuantity, $updateCartQuantity, $expected)
    {
        $productId = $this->mockProducts(['quantity' => $productQuantity])[0]->id;
        $cart = factory(Cart::class)->create([
            'product_id' => $productId,
            'quantity' => $cartQuantity,
            'customer_id' => $this->authCustomer->id,
        ]);
        $response = $this->jsonAuthorized(
            'PUT',
            route('api.carts.update', ['id' => $cart->id]),
            [
                'quantity' => $updateCartQuantity,
            ],[], $this->apiAuthToken());
        $response->assertStatus($expected['code'])->assertJson($expected['response']);
    }

    public function testDelete()
    {
        $productId = $this->mockProducts()[0]->id;
        $quantity = 5;

        $cart = factory(Cart::class)->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id,
        ]);
        $this->assertDatabaseHas('carts', [
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id
        ]);

        $response = $this->jsonAuthorized(
            'DELETE',
            route('api.carts.delete', ['id'=> $cart->id]),
            [],[], $this->apiAuthToken());

        $response->assertStatus(200)->assertJson(['success' => true]);

        $this->assertDatabaseMissing('carts', [
            'product_id' => $productId,
            'quantity' => $quantity,
            'customer_id' => $this->authCustomer->id
        ]);
    }

    /**
     * @throws \Exception
     */
    public function testGetAll()
    {
        $carts = factory(Cart::class, random_int(1, 5))->make([
            'customer_id' => $this->authCustomer->id,
        ])->each(function($cart) {
            $cart->product_id = $this->mockProducts()[0]->id;
            $cart->save();
        });
        $response = $this->jsonAuthorized('GET', route('api.carts.get'), [], [], $this->apiAuthToken());

        $response->assertStatus(200)
            ->assertJson(['cart' => $carts->toArray()]);
    }

    /**
     * @return array
     */
    public function updateDataProvider()
    {
        return [
            'positive set' => [
                'productQuantity' => 5,
                'cartQuantity' => 2,
                'updateCartQuantity' => 1,
                'expected' => [
                    'code' => 200,
                    'response' => [
                        'success' => true,
                    ]
                ]
            ],
            'negative set 422' =>  [
                'productQuantity' => 5,
                'cartQuantity' => 2,
                'updateCartQuantity' => 7,
                'expected' => [
                    'code' => 422,
                    'response' => [
                        'message' => 'The given data is invalid',
                        'errors' => [
                            'quantity' => 'Quantity must be a value between 1 and product quantity',
                        ],
                    ]
                ]
            ],
        ];
    }
}
