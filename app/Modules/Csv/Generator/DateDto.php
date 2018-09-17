<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use Carbon\Carbon;

class DateDto
{
    /** @var string */
    protected $dateFrom;
    /** @var string */
    protected $dateTo;

    /**
     * DateDto constructor.
     *
     * @param string $dateFrom
     * @param string $dateTo
     */
    public function __construct(string $dateFrom, string $dateTo)
    {
        $this->dateFrom = Carbon::parse($dateFrom)->toAtomString();
        $this->dateTo = Carbon::parse($dateTo)->toAtomString();
    }

    /**
     * @return string
     */
    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo(): string
    {
        return $this->dateTo;
    }
}
