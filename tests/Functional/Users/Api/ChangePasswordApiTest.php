<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace Tests\Functional\Users\Api;

use Tests\TestCase;

class ChangePasswordApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testChangePasswordWithoutToken()
    {
        $response = $this->post('/api/password/change', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
    }
}
