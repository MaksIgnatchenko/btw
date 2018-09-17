<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace Tests\Functional\Users\Api;

use Tests\TestCase;

class AuthApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginEmptyFields()
    {
        $response = $this->post('/api/auth/login', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'The given data was invalid.');
        $this->assertEquals($content['errors']['password'][0], 'The password field is required.');
        $this->assertEquals($content['errors']['username'][0], 'The username field is required.');
    }


    public function testLoginWrongPassword()
    {
        $response = $this->post('/api/auth/login', [
            'username' => 'wrong username',
            'password' => 'only letters',
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();
        $this->assertEquals($content['message'], 'The given data was invalid.');
        $this->assertEquals($content['errors']['password'][0], 'The password format is invalid.');
    }
}
