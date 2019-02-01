<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.11.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

trait CartValidatorTrait
{
    /**
     * @return Validator
     */
    protected function validatorAfter($validator)
    {
        $validator->after(function () use ($validator) {

            /** @var Customer $customer */
            $customer = Auth::user();

            if (null === $customer->deliveryInformation) {
                $validator->errors()->add('delivery_information', "No delivery information. Please add before purchasing");
            }


            /** @var CartRepository $cartRepository */
            $cartRepository = app(CartRepository::class);

            $carts = $cartRepository->findCartsWithProducts($customer->id);

            foreach ($carts as $cart) {
                /** @var Product $product */
                $product = $cart->product;
                $productFromCartName = $cart->product['name'];

                $productQuantity = $product->quantity;

                if ($cart->quantity > $productQuantity) {
                    $message = "Quantity {$cart->quantity} isn’t available for item {$productFromCartName}. Please decrease quantity to {$productQuantity} to proceed.";
                    $validator->errors()->add($cart->id, $message);
                }
            }
        });
    }
}
