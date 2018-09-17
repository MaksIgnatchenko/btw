<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use App\Modules\Users\Repositories\CustomerRepository;

class CustomerCsv extends AbstractGenerateCsv implements GenerateCsvInterface
{
    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /**
     * CustomerCsv constructor.
     *
     * @param DateDto $dateDto
     */
    public function __construct(DateDto $dateDto)
    {
        parent::__construct($dateDto);
        $this->customerRepository = app(CustomerRepository::class);
    }

    /**
     * @return array
     */
    public function generate(): array
    {
//        $collection = $this->customerRepository->getInRange($this->dateDto);
        return $this->customerRepository->getInRange($this->dateDto)->toArray();
    }
}
