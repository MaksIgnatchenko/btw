<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace App\Modules\Products\Dto;

class CustomerSearchDto
{
    /** @var int */
    protected $offset;
    /** @var array */
    protected $categoryIds;
    /** @var string */
    protected $keyword;
    /** @var string */
    protected $order;
    /** @var array */
    protected $filters;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return CustomerSearchDto
     */
    public function setOffset($offset): CustomerSearchDto
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    /**
     * @param array $categoryIds
     *
     * @return CustomerSearchDto
     */
    public function setCategoryIds(array $categoryIds = []): CustomerSearchDto
    {
        $this->categoryIds = $categoryIds;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     *
     * @return CustomerSearchDto
     */
    public function setKeyword(string $keyword = null): CustomerSearchDto
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $keyword
     *
     * @return CustomerSearchDto
     */
    public function setOrder(string $order = null): CustomerSearchDto
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param array|null $filters
     *
     * @return CustomerSearchDto
     */
    public function setFilters(array $filters = null): CustomerSearchDto
    {
        $this->filters = $filters;

        return $this;
    }
}
