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
            'item_price' => ['required', 'min:0', 'max:'.MAX_INTEGER_VALUE],
            'brand_id' => ['required', 'exists:brands,id', 'integer', 'max:'.MAX_INTEGER_VALUE],
            'image_file_upload' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:'.UPLOAD_MAX_SIZE],
            'description' => ['nullable', 'max:5000'],
            'image_slides_uploaded' => ['array'],
            'image_slides_uploaded.*.original_name' => ['required'],
            'image_slides_uploaded.*.file_name' => ['required'],
            'keep_product_slide_ids' => ['array'],
            'keep_product_slide_ids.*' => ['integer'],
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

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(
            [
                'image_slides_uploaded' => json_decode($this->image_slides_uploaded, true) ?? [],
                'keep_product_slide_ids' => array_filter(explode(',', $this->keep_product_slide_ids)) ?? [],
            ]
        );
    }
}
