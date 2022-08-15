<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Brand form request
 */
class BrandFormRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:100'],
            'country_id' => ['required', 'exists:countries,id', 'integer', 'max:' . MAX_INTEGER_VALUE],
            'logo_file_upload' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:' . UPLOAD_MAX_SIZE],
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
            'country_id' => 'county',
        ];
    }
}
