<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 24.11.2017
 */

namespace App\Modules\Categories\Requests\Admin;

use App\Modules\Categories\Enums\AttributeTypesEnum;
use App\Modules\Categories\Enums\ParameterTypesEnum;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    protected const NAME_ATTRIBUTE_MAX_SIZE = 50;
    protected const NAME_ATTRIBUTE_MIN_SIZE = 2;

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // TODO refactor it!
    // reuse it?
    protected function getValidatorInstance(): \Illuminate\Contracts\Validation\Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();
            if (isset($data['attributes']) && is_array($data['attributes'])) {
                foreach ($data['attributes'] as $attribute) {
                    try {
                        $decodedAttribute = \GuzzleHttp\json_decode($attribute);
                    } catch (\InvalidArgumentException $e) {
                        $validator->errors()->add('attributes', 'Incorrect json');

                        return;
                    }

                    if (null === $decodedAttribute->name || null === $decodedAttribute->type) {
                        $validator->errors()->add('attributes', 'Empty name or type');

                        return;
                    }

                    $nameLength = mb_strlen($decodedAttribute->name);

                    if (self::NAME_ATTRIBUTE_MIN_SIZE > $nameLength || self::NAME_ATTRIBUTE_MAX_SIZE < $nameLength) {
                        $validator->errors()->add('attributes', 'Wrong attribute name size. Min 2, max 50 symbols');

                        return;
                    }

                    if (!AttributeTypesEnum::check($decodedAttribute->type)) {
                        $validator->errors()->add('attributes', 'Incorrect type');
                    }
                }
            }
        });

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if (isset($data['parameters']) && \is_array($data['parameters'])) {
                foreach ($data['parameters'] as $parameter) {
                    try {
                        $decodedParameter = \GuzzleHttp\json_decode($parameter);
                    } catch (\InvalidArgumentException $e) {
                        $validator->errors()->add('parameters', 'Incorrect json');

                        return;
                    }

                    if (null === $decodedParameter->name) {
                        $validator->errors()->add('parameters', 'Empty name');

                        return;
                    }

                    if (!ParameterTypesEnum::check($decodedParameter->name)) {
                        $validator->errors()->add('parameters', 'Incorrect type');
                    }
                }
            }
        });

        return $validator;
    }
}
