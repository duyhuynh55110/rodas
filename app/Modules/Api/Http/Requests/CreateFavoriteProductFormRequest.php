<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateFavoriteProductFormRequest
 */
class CreateFavoriteProductFormRequest extends FormRequest
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
        ];
    }
}