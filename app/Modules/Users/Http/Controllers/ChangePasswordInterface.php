<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 21.11.2018
 */

namespace App\Modules\Users\Http\Controllers;

interface ChangePasswordInterface
{
    /**
     * @return mixed
     */
    public function onWrongPassword();

    /**
     * @return mixed
     */
    public function returnSuccessResult();
}
