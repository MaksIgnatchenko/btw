<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Strategy;

use App\Modules\Categories\Repositories\CategoryRepository;

abstract class AbstractGetCategories
{
    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * AbstractGetCategories constructor.
     */
    public function __construct()
    {
        $this->categoryRepository = resolve(CategoryRepository::class);
    }
}
