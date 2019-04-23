<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 23.04.2019
 */

namespace Tests\Functional\Customer;


use Tests\TestCase;

class WishControllerTest extends TestCase
{
    public function testAdd()
    {
        $product = $this->mockProduct()[0];

        $response = $this->jsonAuthorized(
            'POST',
            route('api.customer.wish.add', ['product' => $product->id])
        );

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
        ]);

        $this->assertDatabaseHas('wishlists', [
            'customer_id' => $this->authCustomer->id,
            'product_id' => $product->id,
        ]);
    }

    public function testRemove()
    {
        $product = $this->mockProduct()[0];

        $this->addProductToWishList($product);

        $response = $this->jsonAuthorized(
            'DELETE',
            route('api.customer.wish.remove', ['product' => $product->id])
        );

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
        ]);

        $this->assertDatabaseMissing('wishlists', [
            'customer_id' => $this->authCustomer->id,
            'product_id' => $product->id,
        ]);

    }

    /**
     * @param $fixture
     * @param $expected
     * @dataProvider getDataProvider
     */
    public function testGet($fixture, $expected)
    {
        $attr = [];
        if (isset($fixture['product'])) {
            $attr = $fixture['product'];
        }
        $product = $this->mockProduct($attr)[0];
        $this->addProductToWishList($product);

        $response = $this->jsonAuthorized(
            'GET',
            route('api.customer.wish.list'),
            $fixture['request']
        );

        $response->assertStatus($expected['code'])
            ->assertJson($expected['response']);
    }


    protected function addProductToWishList($product)
    {
        $this->jsonAuthorized(
            'POST',
            route('api.customer.wish.add', ['product' => $product->id])
        );
        $this->assertDatabaseHas('wishlists', [
            'customer_id' => $this->authCustomer->id,
            'product_id' => $product->id,
        ]);
    }
    public function getDataProvider()
    {
        return [
            'default set' => [
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                    ],
                ],
                'expected' => [
                    'code' => 200,
                    'response' => [
                        'products' => [],
                    ]
                ],
            ],
            'keyword test set' => [
                'fixture' => [
                    'product' => [
                        'name' => 'test product',
                    ],
                    'request' => [
                        'keyword' => 'test',
                    ],
                ],
                'expected' => [
                    'code' => 200,
                    'response' => [
                        'products' => [
                            [
                                'name' => 'test product',
                            ]
                        ],
                    ]
                ],
            ],
        ];
    }
}