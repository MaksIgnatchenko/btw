<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 30.01.2018
 */

namespace App\Modules\Bidding\Models;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Users\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wish_id',
        'merchant_id',
        'price',
        'tax',
    ];

    protected $casts = [
        'wish_id'     => 'integer',
        'merchant_id' => 'integer',
        'price'       => 'float',
        'tax'         => 'float',
        'total_price' => 'float',
    ];

    /**
     * @param Merchant $merchant
     */
    public function create(Merchant $merchant): void
    {
        $bid = $this;

        /** @var BidRepository $bidRepository */
        $bidRepository = app(BidRepository::class);

        $bid->merchant_id = $merchant->id;

        $bidRepository->save($bid);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wish(): BelongsTo
    {
        return $this->belongsTo(Wish::class);
    }
}
