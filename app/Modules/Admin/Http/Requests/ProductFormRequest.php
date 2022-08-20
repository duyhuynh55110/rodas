<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ProductFormRequest
 */
class ProductFormRequest extends FormRequest
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
            'item_price' => ['required', 'min:0', 'max:' . MAX_INTEGER_VALUE],
            'brand_id' => ['required', 'exists:brands,id', 'integer', 'max:' . MAX_INTEGER_VALUE],
            'image_file_upload' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:' . UPLOAD_MAX_SIZE],
            'description' => ['nullable', 'max:5000'],
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
            'brand_id' => 'brand',
        ];
    }
}
