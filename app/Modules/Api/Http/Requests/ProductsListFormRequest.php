<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ProductsListFormRequest
 */
class ProductsListFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => ['min:1', 'max:199'],
            'is_favorite' => ['integer'],
            'category_ids' => ['array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],

            // paginate
            ...validatePaginationRequestParams(),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'category_ids' => getListByRequestName('category_ids'),
        ]);
    }
}
