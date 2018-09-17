<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.12.2017
 */

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    /** @var array */
    protected $fillable = [
        'user_id',
        'push_token',
        'device_type',
    ];

    protected $casts = [
        'user_id'     => 'integer',
        'push_token'  => 'string',
        'device_type' => 'string',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
