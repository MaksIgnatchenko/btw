<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use Illuminate\Queue\SerializesModels;

class CustomerAddedEvent implements AddRoleEventInterface
{
    use SerializesModels;

    protected $user;
    protected $customer;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Customer $customer
     */
    public function __construct(User $user, Customer $customer)
    {
        $this->user = $user;
        $this->customer = $customer;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
