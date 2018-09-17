<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use App\Modules\Users\Repositories\MerchantRepository;

class MerchantCsv extends AbstractGenerateCsv implements GenerateCsvInterface
{
    /** @var MerchantRepository $merchantRepository */
    protected $merchantRepository;

    /**
     * CustomerCsv constructor.
     *
     * @param DateDto $dateDto
     */
    public function __construct(DateDto $dateDto)
    {
        parent::__construct($dateDto);
        $this->merchantRepository = app(MerchantRepository::class);
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        return $this->merchantRepository->getInRange($this->dateDto)->toArray();
    }
}
