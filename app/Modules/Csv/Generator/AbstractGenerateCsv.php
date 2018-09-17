<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

abstract class AbstractGenerateCsv
{
    /** @var DateDto */
    protected $dateDto;

    /**
     * AbstractGenerateCsv constructor.
     *
     * @param DateDto $dateDto
     */
    public function __construct(DateDto $dateDto)
    {
        $this->dateDto = $dateDto;
    }
}
