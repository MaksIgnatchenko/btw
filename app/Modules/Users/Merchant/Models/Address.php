<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Merchant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    /**
     * Address to merchant relation.
     *
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
