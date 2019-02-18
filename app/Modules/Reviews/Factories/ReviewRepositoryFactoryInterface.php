<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\Factories;

use App\Modules\Reviews\Repositories\ReviewRepositoryInterface;

/**
 * Interface ReviewRepositoryFactoryInterface
 * @package App\Modules\Reviews\Factories
 */
interface ReviewRepositoryFactoryInterface
{
    /**
     * @param string $type
     * @return ReviewRepositoryInterface
     */
    public function getRepository(string $type) : ReviewRepositoryInterface;
}
