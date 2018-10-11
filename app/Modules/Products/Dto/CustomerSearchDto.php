<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace App\Modules\Products\Dto;

class CustomerSearchDto
{
    /** @var int */
    protected $offset;
    /** @var int */
    protected $categoryId;
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
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     *
     * @return CustomerSearchDto
     */
    public function setCategoryId(int $categoryId = null): CustomerSearchDto
    {
        $this->categoryId = $categoryId;

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
