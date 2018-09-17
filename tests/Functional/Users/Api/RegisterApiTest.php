<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

namespace Tests\Functional\Users\Api;

use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    public function testRegisterMerchantWithEmptyFields()
    {
        $response = $this->post('/api/register/merchant', ['categories[]' => 123], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'The given data was invalid.');
        $this->assertEquals($content['errors']['password'][0], 'The password field is required.');
        $this->assertEquals($content['errors']['username'][0], 'The username field is required.');
        $this->assertEquals($content['errors']['email'][0], 'The email field is required.');
        $this->assertEquals($content['errors']['address'][0], 'The address field is required.');
        $this->assertEquals($content['errors']['telephone'][0], 'The telephone field is required.');
        $this->assertEquals($content['errors']['ein'][0], 'The ein field is required.');
        $this->assertEquals($content['errors']['contact'][0], 'The contact field is required.');
        $this->assertEquals($content['errors']['check'][0], 'The check field is required.');
        $this->assertEquals($content['errors']['categories'][0], 'The categories field is required.');
        $this->assertEquals($content['errors']['business_name'][0], 'The business name field is required.');
        $this->assertEquals($content['errors']['payment_option'][0], 'The payment option field is required.');
    }

    public function testWirePaymentOptionWithEmptyOtherFields()
    {
        $response = $this->post(
            '/api/register/merchant',
            ['payment_option' => 'wire'],
            ['Accept' => 'application/json']
        );

        $content = $response->getOriginalContent();

        $this->assertNotContains('paypal_email', $content['errors']);

        $this->assertEquals($content['errors']['wire_account_name'][0], 'The wire account name field is required.');
        $this->assertEquals($content['errors']['wire_account_number'][0], 'The wire account number field is required.');
        $this->assertEquals($content['errors']['wire_bank_name'][0], 'The wire bank name field is required.');
        $this->assertEquals($content['errors']['wire_aba_number'][0], 'The wire aba number field is required.');
    }

    public function testPaypalPaymentOptionWithEmptyOtherFields()
    {
        $response = $this->post(
            '/api/register/merchant',
            ['payment_option' => 'paypal'],
            ['Accept' => 'application/json']
        );

        $content = $response->getOriginalContent();

        $this->assertEquals($content['errors']['paypal_email'][0], 'The paypal email field is required.');

        $this->assertNotContains('wire_account_name', $content['errors']);
        $this->assertNotContains('wire_account_number', $content['errors']);
        $this->assertNotContains('wire_bank_name', $content['errors']);
        $this->assertNotContains('wire_aba_number', $content['errors']);
    }

    public function testWireAccountNumberValidation()
    {
        $response = $this->post('/api/register/merchant', [
            'payment_option'      => 'wire',
            'wire_account_number' => str_random(60),
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertNotContains('paypal_email', $content['errors']);

        $this->assertEquals(
            $content['errors']['wire_account_number'][0],
            'The wire account number must be between 1 and 50 digits.'
        );
    }

    public function testWireAccountNumberValidationCorrect()
    {
        $response = $this->post('/api/register/merchant', [
            'payment_option'      => 'wire',
            'wire_account_number' => 1234,
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertNotContains('wire_account_number', $content['errors']);
    }

    public function testNamesValidation()
    {
        $response = $this->post('/api/register/merchant', [
            'business_name' => 'a',
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertNotContains('business_name', $content['errors']);


        $response = $this->post('/api/register/customer', [
            'first_name' => 'a',
            'last_name'  => 'a',
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertNotContains('first_name', $content['errors']);
        $this->assertNotContains('last_name', $content['errors']);

        $response = $this->post('/api/register/customer', [
            'username' => 'a qqqqqqqqqqq',
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals(
            $content['errors']['username'][0],
            'The username may only contain letters and numbers.'
        );

        $response = $this->post('/api/register/customer', [
            'username' => 'Use12',
        ], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertNotEquals('The username may only contain letters and numbers.', $content['errors']['username'][0]);
    }
}
