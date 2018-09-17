<?php

namespace App\Modules\Bidding\Http\Requests\Api;

use App\Modules\Products\Repositories\ProductRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateWishRequest extends FormRequest
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
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'desired_price' => 'required|numeric|min:0|max:999999.99',
            'max_price'     => 'required|numeric|min:0|max:999999.99',
            'bid_end'       => 'required|integer|in:1,2,3',
            'longitude'     => 'sometimes|numeric',
            'latitude'      => 'sometimes|numeric',
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

            if(!isset($data['desired_price']) || !$data['max_price']) {
                return;
            }

            if ($data['desired_price'] > $data['max_price']) {
                $validator->errors()->add('desired_price', 'Desired price should be less or equal to Maximum price.');
            }
        });

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if(!isset($data['product_id'])) {
                return;
            }

            /** @var ProductRepository $productRepository */
            $productRepository = app(ProductRepository::class);
            $product = $productRepository->findActiveById($data['product_id']);

            if (null === $product) {
                $validator->errors()->add('product_id', 'Product\'s offer end should be more than now');
            }
        });

        return $validator;
    }
}
