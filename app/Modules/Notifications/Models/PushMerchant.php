<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PushMerchant extends Model implements PushSettingsInterface
{
    public $incrementing = false;

    protected $primaryKey = 'merchant_id';
    protected $table = 'push_merchant';

    protected $fillable = [
        'merchant_id',
        'enabled',
        'review',
        'wish_list',
        'new_transaction',
    ];

    protected $visible = [
        'enabled',
        'review',
        'wish_list',
        'new_transaction',
    ];

    protected $casts = [
        'merchant_id'     => 'integer',
        'enabled'         => 'boolean',
        'review'          => 'boolean',
        'wish_list'       => 'boolean',
        'new_transaction' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo('merchants');
    }
}