<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 29.11.2018
 */

namespace App\Modules\Users\Customer\Events;

use App\Modules\Users\Customer\Models\Customer;
use Intervention\Image\Image;

class CustomerCreatedFromFacebookEvent
{
    /** @var Customer */
    protected $customer;

    /** @var string */
    protected $avatarImageName;

    /** @var Image */
    protected $avatarImage;

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return CustomerCreatedFromFacebookEvent
     */
    public function setCustomer(Customer $customer): CustomerCreatedFromFacebookEvent
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarImageName(): string
    {
        return $this->avatarImageName;
    }

    /**
     * @param string $avatarImageName
     * @return CustomerCreatedFromFacebookEvent
     */
    public function setAvatarImageName(string $avatarImageName): CustomerCreatedFromFacebookEvent
    {
        $this->avatarImageName = $avatarImageName;

        return $this;
    }

    /**
     * @return Image
     */
    public function getAvatarImage(): Image
    {
        return $this->avatarImage;
    }

    /**
     * @param Image $avatarImage
     * @return CustomerCreatedFromFacebookEvent
     */
    public function setAvatarImage(Image $avatarImage): CustomerCreatedFromFacebookEvent
    {
        $this->avatarImage = $avatarImage;

        return $this;
    }
}
