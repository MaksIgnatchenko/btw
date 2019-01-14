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
    /** @var string */
    protected $primaryKey = 'customer_id';

    /** @var array */
    protected $hidden = [
        'customer_id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'customer_id',
        'country',
        'street',
        'apartment',
        'city',
        'state',
        'zip',
        'notes',
    ];

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
