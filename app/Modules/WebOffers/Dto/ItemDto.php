<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.02.2018
 */

namespace App\Modules\WebOffers\Dto;

class ItemDto
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $merchant;
    /** @var float */
    protected $price;
    /** @var string */
    protected $imageUrl;
    /** @var string */
    protected $url;
    /** @var float */
    protected $rating;

    /**
     * @param string $name
     *
     * @return ItemDto
     */
    public function setName(string $name): ItemDto
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $merchant
     *
     * @return ItemDto
     */
    public function setMerchant(string $merchant): ItemDto
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * @param float $price
     *
     * @return ItemDto
     */
    public function setPrice(float $price): ItemDto
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param string $imageUrl
     *
     * @return ItemDto
     */
    public function setImageUrl(string $imageUrl): ItemDto
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return ItemDto
     */
    public function setUrl(string $url): ItemDto
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'merchant' => $this->merchant,
            'price'    => $this->price,
            'imageUrl' => $this->imageUrl,
            'url'      => $this->url,
            'rating'   => $this->rating,
        ];
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     *
     * @return ItemDto
     */
    public function setRating(float $rating): ItemDto
    {
        $this->rating = $rating;

        return $this;
    }
}
