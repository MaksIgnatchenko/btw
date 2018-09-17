<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.12.2017
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Dto\Attributes\AttributesDtoFactory;
use App\Modules\Products\Dto\Parameters\ParametersFactory;
use App\Modules\Products\Models\ProductImage;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SetProductRequest extends FormRequest
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
            'category_id'             => 'required|exists:categories,id',
            'attributes'              => 'sometimes|json',
            'parameters'              => 'sometimes|json',
            'name'                    => 'required|string|max:50',
            'description'             => 'required|string|max:1000',
            'regular_price'           => 'required|regex:/^[\d]{1,}.[\d]{2}$/',
            'offer_price'             => 'required|regex:/^[\d]{1,}.[\d]{2}$/',
            'tax'                     => 'required|numeric|between:0,100',
            'main_image'              => 'required|image|mimes:jpg,jpeg,png|image_size:<='
                . ProductImage::IMAGE_MAX_DIMENSION
                . '|max:'
                . ProductImage::IMAGE_MAX_SIZE,
            'images'                  => 'sometimes|array|max:' . ProductImage::IMAGES_MAX_COUNT,
            'images.*'                => 'sometimes|image|mimes:jpg,jpeg,png|image_size:<='
                . ProductImage::IMAGE_MAX_DIMENSION
                . '|max:' . ProductImage::IMAGE_MAX_SIZE,
            'barcode'                 => 'sometimes|string|max:20',
            'offer_end'               => 'required|date_format:"U"',
            'certificate'             => 'required|boolean',
            'return_details'          => 'required|string|max:1000',
            'store_delivery'          => 'required|boolean',
            'local_delivery'          => 'required|boolean',
            'local_delivery_distance' => 'required_if:local_delivery,true|integer|min:1|max:999',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'regular_price.regex' => 'Regular price should be in money format. E.g. 199.95',
            'offer_price.regex'   => 'Offer price should be in money format. E.g. 199.95',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \App\Modules\Products\Exceptions\WrongAttributesFormatException
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        // TODO refactor it
        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if (!$this->checkAttributes($data, $validator)) {
                return;
            }

            $attributes = \GuzzleHttp\json_decode($data['attributes']);
            foreach ($attributes as $name => $attribute) {
                $attributeDto = AttributesDtoFactory::get($name, $attribute);
                if (!$attributeDto->validate()) {
                    $validator->errors()->add('attributes', 'Wrong format for attributes!');

                    return;
                }
            }
        });

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if (!$this->checkParameters($data, $validator)) {
                return;
            }

            $parameters = \GuzzleHttp\json_decode($data['parameters']);
            foreach ($parameters as $type => $value) {
                $parameterDto = ParametersFactory::get($type, $value);
                if (!$parameterDto->validate()) {
                    $validator->errors()->add('parameters', 'Wrong format for parameters!');

                    return;
                }
            }
        });

        $validator->after(function ($input) use ($validator) {
            $data = $input->getData();

            if (!isset($data['local_delivery']) || !isset($data['store_delivery'])) {
                $validator->errors()->add('local_delivery', 'One of delivery types should be true');
                return;
            }

            if (false === $data['local_delivery'] && false === $data['store_delivery']) {
                $validator->errors()->add('local_delivery', 'One of delivery types should be true');
            }
        });

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

    /**
     * @param array $data
     * @param $validator
     *
     * @return bool
     */
    protected function checkAttributes(array $data, $validator): bool
    {
        if (!isset($data['attributes'])) {
            return false;
        }
        if (isset($validator->errors()->messages()['attributes'])) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @param $validator
     *
     * @return bool
     */
    protected function checkParameters(array $data, $validator): bool
    {
        if (!isset($data['parameters'])) {
            return false;
        }
        if (isset($validator->errors()->messages()['parameters'])) {
            return false;
        }

        return true;
    }
}
