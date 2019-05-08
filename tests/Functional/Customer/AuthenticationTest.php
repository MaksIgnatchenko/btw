<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 22.04.2019
 */

namespace Tests\Functional\Customer;


use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Services\Social\SocialServiceFacebook;
use App\Modules\Users\Customer\Services\Social\SocialServiceGoogle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
//TODO: fix issue with this test on Gitlab CI
//    public function testLogout()
//    {
//        $token = $this->apiAuthToken();
//        $response = $this->jsonAuthorized(
//            'POST',
//            route('api.customer.logout'),
//            [], [], $token
//        );
//        if($response->getStatusCode() !== 200) {
//            Log::error($response->getContent());
//        }
//        $response->assertStatus(200)
//            ->assertJson(['message' => 'Successfully logged out']);
//
//        $this->assertFalse(auth()->guard('customer')->check($token));
//    }
//TODO: fix issue with this test on Gitlab CI
//    public function testRefresh()
//    {
//        $token = $this->apiAuthToken();
//        $response = $this->jsonAuthorized('POST',
//            route('api.customer.refresh'),
//            [], [], $token
//        );
//
//        $response->assertStatus(200);
//
//    }

    public function testSocialLogin()
    {
        $this->mockSocialProviders();
        $response = $this->jsonAuthorized(
            'POST',
            route('api.customer.social.login', ['service' => 'facebook']),
            ['token' => 'test_token', 'device' => 'android']
        );
        $response->assertStatus(200);

        $response = $this->jsonAuthorized(
            'POST',
            route('api.customer.social.login', ['service' => 'google']),
            ['token' => 'test_token', 'device' => 'ios']
        );
        $response->assertStatus(200);

    }

    protected function mockSocialProviders(){
        $this->mockFacebookService();
        $this->mockGoogleService();
    }

    protected function mockGoogleService()
    {
        $this->app->bind(SocialServiceGoogle::class, function($app) {
            return new class {
                public $test = true;
                public $data = [];
                public function setData(array $data)
                {
                    $this->data = $data;
                }
                public function getUserData() : array
                {
                    return [
                        'email' => 'test@email.test',
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'password' => 'passworD123$',
                        'picture' => [
                            'data' => [
                                'url' => public_path('/img/test/picture.jpeg'),
                                'is_silhouette' => false,
                            ]
                        ]
                    ];
                }
            };
        });
    }
    protected function mockFacebookService()
    {
        $this->app->bind(SocialServiceFacebook::class, function($app) {
            return new class {
                public $test = true;
                public $data = [];
                public function setData(array $data)
                {
                    $this->data = $data;
                }
                public function getUserData() : array
                {
                    return [
                        'email' => 'test@email.test',
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'password' => 'passworD123$',
                        'picture' => [
                            'data' => [
                                'url' => public_path('/img/test/picture.jpeg'),
                                'is_silhouette' => false,
                            ]
                        ]
                    ];
                }
            };
        });
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