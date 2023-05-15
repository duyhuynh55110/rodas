<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateOrderIssueFormRequest
 */
class CreateOrderIssueFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'zip_code' => ['required', 'integer'],
            'city' => ['required', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
            'phone' => ['required', 'integer', 'digits_between:9,10'],
            'address' => ['required', 'max:255'],

            'order_products' => ['required', 'array'],
            'order_products.*.id' => ['required', 'integer', 'exists:products,id'],
            'order_products.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
