<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Payments\Repositories;

use App\Modules\Payments\Models\WireTransferOption;
use InfyOm\Generator\Common\BaseRepository;

class WireRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return WireTransferOption::class;
    }
}