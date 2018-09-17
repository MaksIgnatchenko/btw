<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use App\Modules\Orders\Repositories\OutcomeRepository;

class PayoutCsv extends AbstractGenerateCsv implements GenerateCsvInterface
{
    /** @var OutcomeRepository $outcomeRepository */
    protected $outcomeRepository;

    /**
     * CustomerCsv constructor.
     *
     * @param DateDto $dateDto
     */
    public function __construct(DateDto $dateDto)
    {
        parent::__construct($dateDto);
        $this->outcomeRepository = app(OutcomeRepository::class);
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        return $this->outcomeRepository->getInRange($this->dateDto)->toArray();
    }
}
