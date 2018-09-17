<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use App\Modules\Orders\Repositories\OrderRepository;

class IncomeCsv extends AbstractGenerateCsv implements GenerateCsvInterface
{
    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    /**
     * CustomerCsv constructor.
     *
     * @param DateDto $dateDto
     */
    public function __construct(DateDto $dateDto)
    {
        parent::__construct($dateDto);
        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        return $this->orderRepository->getInRange($this->dateDto)->toArray();
    }
}
