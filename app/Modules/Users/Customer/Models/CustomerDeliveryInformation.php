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

class CustomerDeliveryInformation extends Model
{
    /** @var $table */
    protected $table = 'customer_delivery_information';
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
        'phone',
    ];

    /**
     * Address to customer relation.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
