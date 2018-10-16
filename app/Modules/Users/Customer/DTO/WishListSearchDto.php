<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Customer\DTO;

class WishListSearchDto
{
    /** @var string */
    protected $keyword;
    /** @var integer */
    protected $offset;

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     *
     * @return $this
     */
    public function setKeyword(string $keyword = null)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset(int $offset = 0)
    {
        $this->offset = $offset;

        return $this;
    }
}
