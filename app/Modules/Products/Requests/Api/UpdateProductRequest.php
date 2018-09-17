<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use Illuminate\Contracts\Validation\Validator;

class UpdateProductRequest extends SetProductRequest
{
    public function rules(): array
    {
        return parent::rules() + [
                'product_id' => 'required|exists:products,id'
            ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \App\Modules\Products\Exceptions\WrongAttributesFormatException
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            $regularPrice = $data['regular_price'] ?? 0;
            $offerPrice = $data['offer_price'] ?? 0;

            if ($offerPrice > $regularPrice) {
                $validator->errors()->add('regular_price', 'Offer price should be less or equal to regular price');
            }
        });

        return $validator;
    }
}
