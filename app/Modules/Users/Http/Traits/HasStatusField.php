<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 27.03.2019
 */

namespace App\Modules\Users\Http\Traits;

trait HasStatusField
{
    /**
     * @return bool
     */
    public function isPending() : bool
    {
        return 'pending' === $this->status;
    }

    /**
     * @return bool
     */
    public function isInactive() : bool
    {
        return 'inactive' === $this->status;
    }
}