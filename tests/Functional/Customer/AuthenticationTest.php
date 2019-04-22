<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 22.04.2019
 */

namespace Tests\Functional\Customer;


use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * @param $fixture
     * @param $expected
     * @dataProvider customerRegistrationDataProvider
     */
    public function testCustomerRegistration($fixture, $expected)
    {
        $response = $this->postJson(route('api.customer.register'), $fixture);
        $response->assertStatus($expected['code'])->assertJson($expected['response']);
    }

    /**
     * @param $fixture
     * @param $expected
     * @dataProvider customerLoginDataProvider
     */
    public function testCustomerLogin($fixture, $expected)
    {
        $customer = factory(Customer::class)->create($fixture['customer']);
        unset($fixture['customer']['password']);
        $this->assertDatabaseHas('customers', $fixture['customer']);
        $response = $this->postJson(route('api.customer.login'), $fixture['request']);

        $response->assertStatus($expected['code'])->assertJson($expected['response']);
    }

    public function testMe()
    {
        $response = $this->jsonAuthorized('POST', route('api.customer.me'));

        $response->assertStatus(200)->assertJson($this->authCustomer->toArray());
    }

    public function testLogout()
    {
        $token = $this->apiAuthToken();
        $response = $this->jsonAuthorized('POST', route('api.customer.logout'), [], [], $token);

        $response->assertStatus(200)->assertJson(['message' => 'Successfully logged out']);

        $this->assertFalse(auth()->guard('customer')->check($token));
    }

    public function testRefresh()
    {
        $token = $this->apiAuthToken();
        $response = $this->jsonAuthorized('POST', route('api.customer.refresh'), [], [], $token);

        $response->assertStatus(200);

    }
    /**
     * @return array
     */
    public function customerRegistrationDataProvider() : array
    {
        return [
            'positive set' => [
                'fixture' => [
                    'first_name' => 'Test',
                    'last_name' => 'User',
                    'email' => 'test@user.test',
                    'password' => 'passworD123$',
                    'password_confirmation' => 'passworD123$',
                ],

                'expected' => [
                    'code' => 200,
                    'response' => [
                        'customer' => [
                            'email' => 'test@user.test',
                            'first_name' => 'Test',
                            'last_name' => 'User',
                        ]
                    ]
                ],

            ],
            'password validation set' => [
                'fixture' => [
                    'first_name' => 'Test',
                    'last_name' => 'User',
                    'email' => 'test@user.test',
                    'password' => 'passworD123',
                    'password_confirmation' => 'passworD123',
                ],

                'expected' => [
                    'code' => 422,
                    'response' => [
                    ]
                ],

            ],

        ];
    }
    /**
     * @return array
     */
    public function customerLoginDataProvider() : array
    {
        return [
            'positive set' => [
                'fixture' => [
                    'customer' => [
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'email' => 'test@user.test',
                        'password' => 'passworD123$',
                        'status' => 'active',
                    ],
                    'request' => [
                        'email' => 'test@user.test',
                        'password' => 'passworD123$'
                    ],
                ],
                'expected' => [
                    'code' => 200,
                    'response' => [],
                ]
            ],
            'inactive customer set' => [
                'fixture' => [
                    'customer' => [
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'email' => 'test@user.test',
                        'password' => 'passworD123$',
                        'status' => 'inactive',
                    ],
                    'request' => [
                        'email' => 'test@user.test',
                        'password' => 'passworD123$'
                    ],
                ],
                'expected' => [
                    'code' => 403,
                    'response' => [],
                ]
            ],
            'wrong customer password set' => [
                'fixture' => [
                    'customer' => [
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'email' => 'test@user.test',
                        'password' => 'passworD123$',
                        'status' => 'active',
                    ],
                    'request' => [
                        'email' => 'test@user.test',
                        'password' => 'passworD123$12'
                    ],
                ],
                'expected' => [
                    'code' => 401,
                    'response' => [],
                ]
            ],
            'wrong customer email set' => [
                'fixture' => [
                    'customer' => [
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'email' => 'test@user.test',
                        'password' => 'passworD123$',
                        'status' => 'active',
                    ],
                    'request' => [
                        'email' => 'test@user.test2',
                        'password' => 'passworD123$'
                    ],
                ],
                'expected' => [
                    'code' => 401,
                    'response' => [],
                ]
            ],
        ];
    }


}