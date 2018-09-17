<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.02.2018
 */

namespace App\Modules\Bidding\Http\Requests\Api;

use App\Modules\Bidding\Repositories\DeclinedWishRepository;
use App\Modules\Bidding\Repositories\WishRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDeclinedWishRequest extends FormRequest
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
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if (!isset($data['wish_id'])) {
                return;
            }

            $user = Auth::user();
            $merchant = $user->merchant;

            /** @var DeclinedWishRepository $declinedWishRepository */
            $declinedWishRepository = app(DeclinedWishRepository::class);
            $declinedWish = $declinedWishRepository->findWhere([
                'wish_id'     => $data['wish_id'],
                'merchant_id' => $merchant->id
            ]);

            if (!$declinedWish->isEmpty()) {
                $validator->errors()->add('wish_id', 'You are already declined this wish.');
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

        return $validator;
    }
}
