<?php

namespace App\Modules\Bidding\Repositories;

use App\Modules\Bidding\Models\Bid;
use InfyOm\Generator\Common\BaseRepository;

class BidRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Bid::class;
    }

    /**
     * @param Bid $bid
     */
    public function save(Bid $bid): void
    {
        $bid->save();
    }
}
