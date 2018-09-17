<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Enums\CartDeliveryOptionEnum;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function () use ($validator) {
            /** @var User $user */
            $user = Auth::user();
            /** @var Customer $customer */
            $customer = $user->customer;
            /** @var CartRepository $cartRepository */
            $cartRepository = app(CartRepository::class);
            $carts = $cartRepository->findWhereProductSource($customer->id);

            // TODO how to make it prettier?
            foreach ($carts as $cart) {
                /** @var Product $product */
                $product = $cart->productRelation;
                $productFromCartName = $cart->product['name'];

                if (Carbon::now() > $product->offer_end) {
                    $message = "Offer date for item {$productFromCartName} has expired. Please delete it from the cart to proceed.";
                    $validator->errors()->add($cart->id, $message);
                }

                $productQuantity = $product->getQuantity();
                if (null !== $productQuantity && $cart->quantity > $productQuantity) {
                    $message = "Quantity {$cart->quantity} isn’t available for item {$productFromCartName}. Please decrease quantity to {$productQuantity} to proceed.";
                    $validator->errors()->add($cart->id, $message);
                }

                if (null === $customer->deliveryAddress && $cart->delivery_option === CartDeliveryOptionEnum::LOCAL_DELIVERY) {
                    $message = "Item {$productFromCartName} has a free delivery option. Please, enter your delivery address to proceed.";
                    $validator->errors()->add($cart->id, $message);
                }
            }
        });


        return $validator;
    }
}
