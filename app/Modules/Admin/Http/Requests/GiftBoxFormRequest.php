<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * GiftBoxFormRequest
 */
class GiftBoxFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['required', 'max:100'],
            'price' => ['required', 'integer', 'min:0', 'max:' . MAX_INTEGER_VALUE],
            'image_file_upload' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:' . UPLOAD_MAX_SIZE],

            // gift box product array
            'gift_box_products' => ['array'],
            'gift_box_products.*.product_id' => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'gift_box_products.*.quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . MAX_INTEGER_VALUE
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'gift_box_products' => 'products',
            'gift_box_products.product_id' => 'product id',
            'gift_box_products.quantity' => 'product quantity',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(
            [
                'gift_box_products' => json_decode($this->gift_box_products, true) ?? [],
            ]
        );
    }
}
