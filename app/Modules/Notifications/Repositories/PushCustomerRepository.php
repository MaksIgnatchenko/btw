<?php

namespace App\Modules\Notifications\Repositories;

use App\Modules\Notifications\Models\PushCustomer;
use InfyOm\Generator\Common\BaseRepository;

class PushCustomerRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return PushCustomer::class;
    }

    /**
     * @param PushCustomer $pushCustomer
     */
    public function save(PushCustomer $pushCustomer): void
    {
        $pushCustomer->save();
    }
}
