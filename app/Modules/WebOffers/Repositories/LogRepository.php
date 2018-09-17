<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.02.2018
 */

namespace App\Modules\WebOffers\Repositories;

use App\Modules\WebOffers\Models\Log;
use InfyOm\Generator\Common\BaseRepository;

class LogRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Log::class;
    }

    /**
     * @param Log $log
     */
    public function save(Log $log): void
    {
        $log->save();
    }
}
