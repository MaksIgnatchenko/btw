<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 20.04.2019
 */

namespace Tests\Functional;

use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }


    public function testGenerateToken()
    {
        $response = $this->jsonAuthorized('GET', route('transaction.token'));

        $response->assertStatus(200)->assertJson(['token' => 'test token']);
    }

    /**
     * @dataProvider createProvider
     * @param $fixture
     * @param $expected
     */
    public function testCreate($fixture, $expected)
    {
        $response = $this->jsonAuthorized('POST', route('api.transaction.create'), $fixture);
        
        $this->assertDatabaseHas('transactions', $expected['row']);
        $response->assertStatus($expected['response']['status'])->assertJson($expected['response']['json']);
    }


    public function createProvider() : array
    {
        return [
            'positive set' => [
                'input' => [
                    'amount' => 10,
                    'noncence' => 'success',
                ],
                'expected' => [
                    'row' => [
                        'status' => 'success',
                        'amount' => 10,
                        'message' => null,
                    ],
                    'response' => [
                        'status' => 200,
                        'json' => ['success' => true]
                    ]
                ]
            ],
            'negative set' => [
                'input' => [
                    'amount' => 10,
                    'noncence' => 'error',
                ],
                'expected' => [
                    'row' => [
                        'status' => 'fail',
                        'amount' => 10,
                        'message' => 'Test message',
                    ],
                    'response' => [
                        'status' => 400,
                        'json' => ['success' => false]
                    ]
                ]
            ]
        ];
    }
}
