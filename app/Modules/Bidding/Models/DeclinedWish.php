<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.02.2018
 */

namespace App\Modules\Bidding\Models;

use App\Modules\Users\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeclinedWish extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wish_id',
        'merchant_id',
    ];

    protected $casts = [
        'wish_id'     => 'integer',
        'merchant_id' => 'integer',
    ];


    /**
     * @return HasMany
     */
    public function wish(): HasMany
    {
        return $this->hasMany(Wish::class);
    }

    /**
     * @return HasMany
     */
    public function merchant(): HasMany
    {
        return $this->hasMany(Merchant::class);
    }
}
