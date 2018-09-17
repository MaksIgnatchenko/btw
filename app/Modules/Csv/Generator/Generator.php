<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use App\Modules\Csv\Enums\CsvGeneratorTypeEnum;
use App\Modules\Csv\Exceptions\WrongGeneratorCsvType;

class Generator
{
    /** @var string $type */
    protected $type;
    /** @var DateDto $dateDto */
    protected $dateDto;

    /**
     * Generator constructor.
     *
     * @param string $type
     * @param DateDto $dateDto
     */
    public function __construct(string $type, DateDto $dateDto)
    {
        $this->type = $type;
        $this->dateDto = $dateDto;
    }

    /**
     * @return GenerateCsvInterface
     * @throws WrongGeneratorCsvType
     */
    public function getCsvDataGenerator(): GenerateCsvInterface
    {
        switch ($this->type) {
            case CsvGeneratorTypeEnum::CUSTOMERS:
                return new CustomerCsv($this->dateDto);
            case CsvGeneratorTypeEnum::MERCHANTS:
                return new MerchantCsv($this->dateDto);
            case CsvGeneratorTypeEnum::PAYOUT:
                return new PayoutCsv($this->dateDto);
            case CsvGeneratorTypeEnum::INCOME:
                return new IncomeCsv($this->dateDto);

            default:
                throw new WrongGeneratorCsvType("Wrong type - {$this->type}");
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return "{$this->type}_from_{$this->dateDto->getDateFrom()}_to_{$this->dateDto->getDateTo()}";
    }
}
