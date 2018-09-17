<?php

namespace App\Modules\Bidding\Http\Requests\Api;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Bidding\Repositories\WishRepository;
use App\Modules\Products\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBidRequest extends FormRequest
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
            'wish_id' => 'required|exists:wishes,id',
            'price'   => 'required|numeric|min:0|max:999999.99',
            'tax'     => 'required|numeric|min:0|max:100',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        // TODO проверка на declined
        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();
            /** @var  WishRepository $wishRepository */
            $wishRepository = app(WishRepository::class);
            if (!isset($data['wish_id'])) {
                return;
            }
            $wish = $wishRepository->find($data['wish_id']);

            $bidPrice = $data['price'];

            if ($bidPrice > $wish->max_price) {
                $validator->errors()->add(
                    'desired_price',
                    'The sum of bid price should be less or equal to Maximum price.'
                );
            }
        });

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();
            /** @var  WishRepository $wishRepository */
            $wishRepository = app(WishRepository::class);
            if (!isset($data['wish_id'])) {
                return;
            }
            $wish = $wishRepository->find($data['wish_id']);

            if ($wish->end_date < Carbon::now()) {
                $validator->errors()->add('wish_id', 'Wish end date should be in future.');
            }
        });

        $validator->after(function ($input) use ($validator) {
            $user = Auth::user();
            $merchant = $user->merchant;
            $data = $input->getData();

            /** @var  BidRepository $bidRepository */
            $bidRepository = app(BidRepository::class);
            if (!isset($data['wish_id'])) {
                return;
            }
            $bid = $bidRepository->findWhere(['merchant_id' => $merchant->id, 'wish_id' => $data['wish_id']]);

            if (!$bid->isEmpty()) {
                $validator->errors()->add('wish_id', 'You already bid this wish');
            }
        });

        return $validator;
    }
}
