<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Products\Enums\CartDeliveryOptionEnum;
use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CreateCartRequest extends FormRequest
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
        return [
            'source' => ['required', Rule::in(CartSourceEnum::getValues())],
            'product_id' => 'required_if:source,==,' . CartSourceEnum::PRODUCT . '|exists:products,id',
            'bid_id' => 'required_if:source,==,' . CartSourceEnum::BID . '|exists:bids,id',

            'delivery_option' => [
                'required_if:source,==' . CartSourceEnum::PRODUCT,
                Rule::in(CartDeliveryOptionEnum::getValues())
            ],
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \App\Modules\Products\Exceptions\WrongAttributesFormatException
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        /** @var BidRepository $bidRepository */
        $bidRepository = app(BidRepository::class);
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);
        $user = Auth::user();
        $customer = $user->customer;

        $validator->after(function ($input) use ($validator, $bidRepository, $customer) {
            $data = $input->getData();

            if (CartSourceEnum::BID !== $data['source']) {
                return;
            }

            $bidId = \GuzzleHttp\json_decode($data['bid_id']);
            $bid = $bidRepository->findWithoutFail($bidId);
            if (!$bid) {
                return;
            }

            $wish = $bid->wish;

            if ($wish->customer_id !== $customer->id) {
                $validator->errors()->add('bid_id', 'You are not allowed to add this bid to cart.');
            }
            if ($wish->is_added_to_cart) {
                $validator->errors()->add('bid_id', 'You already added this bid to cart.');
            }
            $now = new Carbon();
            $startDate = new Carbon($wish->end_date);
            $endDate = (new Carbon($wish->end_date))->modify('+ 2 days');

            if (!$now->between($startDate, $endDate)) {
                $validator->errors()->add('bid_id', 'Wrong wish date.');
            }
        });

        $validator->after(function ($input) use ($validator, $productRepository) {
            $data = $input->getData();

            if (!isset($data['source']) && CartSourceEnum::PRODUCT !== $data['source']) {
                return;
            }

            if (!isset($data['delivery_option'], $data['product_id'])) {
                return;
            }
            $deliveryOption = $data['delivery_option'];

            $product = $productRepository->find($data['product_id']);

            if (CartDeliveryOptionEnum::LOCAL_DELIVERY === $deliveryOption && !$product->localDelivery->active) {
                $validator->errors()->add(
                    'delivery_option',
                    'Product doesn\'t have local_delivery option. Please choose another delivery option'
                );

                return;
            }

            if (CartDeliveryOptionEnum::STORE_DELIVERY === $deliveryOption && !$product->store_delivery) {
                $validator->errors()->add(
                    'delivery_option',
                    'Product doesn\'t have store_delivery option. Please choose another delivery option'
                );

                return;
            }
        });

        return $validator;
    }
}
