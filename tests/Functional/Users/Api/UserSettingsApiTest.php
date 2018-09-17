<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace Tests\Functional\Users\Api;

use Tests\TestCase;

class UserSettingsApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetSettingsUnauthorized()
    {
        $response = $this->get('/api/settings/get', ['Accept' => 'application/json']);
        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSetSettingsUnauthorized()
    {
        $response = $this->post('/api/settings/set', [], ['Accept' => 'application/json']);
        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
    }
}
