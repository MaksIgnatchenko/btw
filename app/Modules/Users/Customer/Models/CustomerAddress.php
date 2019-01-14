<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-14
 * Time: 14:54
 */

namespace App\Modules\Users\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    /**
     * Address to merchant relation.
     *
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
