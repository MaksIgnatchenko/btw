<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 24.04.2019
 */

namespace Tests\Functional\Customer;


use App\Modules\Users\Customer\Mails\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetControllerTest extends TestCase
{

    public function testEmailSend()
    {
        Notification::fake();

        $response = $this->json(
            'POST',
            route('password.email'),
            ['email' => $this->authCustomer->email]);

        $response->assertStatus(200)->assertJson(['success' => true]);
        Notification::assertSentTo(
            $this->authCustomer,
            ResetPasswordMail::class
        );

    }

    public function testEmailSendNegative()
    {
        Notification::fake();

        $response = $this->json(
            'POST',
            route('password.email'),
            ['email' => $this->authCustomer->email . '1233']);

        $response->assertStatus(422)->assertJson(['message' => 'No such email']);
        Notification::assertNotSentTo(
            $this->authCustomer,
            ResetPasswordMail::class
        );

    }

    public function testChangePassword()
    {
        $oldPassword = 'oldPassword1$';
        $newPassword = 'NewPassword1$';
        $this->authCustomer->password = $oldPassword;
        $this->authCustomer->save();

        $response = $this->jsonAuthorized(
            'POST',
            route('password.change'),
            [
                'old_password' => $oldPassword,
                'new_password' => $newPassword,
            ]
        );

        $response->assertStatus(200)->assertJson([
            'message' => 'Password changed successfully'
        ]);
    }
    public function testChangePasswordNegative()
    {
        $oldPassword = 'oldPassword1$';
        $newPassword = 'NewPassword1$';

        $response = $this->jsonAuthorized(
            'POST',
            route('password.change'),
            [
                'old_password' => $oldPassword,
                'new_password' => $newPassword,
            ]
        );

        $response->assertStatus(400)->assertJson([
            'message' => 'Wrong old password. Please try again'
        ]);
    }

}