<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 27.03.2019
 */

namespace App\Modules\Users\Http\Traits;

trait HasStatusField
{

    public function isPending()
    {
        return 'pending' === $this->status;
    }

    public function isInactive()
    {
        return 'inactive' === $this->status;
    }
}