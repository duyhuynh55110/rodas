<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * CreateProductToCartFormRequest
 */
class CreateProductToCartFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0'],
            'type' => [
                'required',
                Rule::in([ADD_TO_CART_TYPE_INSERT, ADD_TO_CART_TYPE_UPDATE])
            ]
        ];
    }
}
