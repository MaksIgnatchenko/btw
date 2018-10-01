<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Services\Social;

abstract class SocialServiceAbstract
{
   /** @var string $token */
    protected $token;

    /** @var array  $credentials */
    protected $credentials;

    /**
     * SocialServiceAbstract constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
}
