<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * NotificationsListFormRequest
 */
class NotificationsListFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // paginate
            ...validatePaginationRequestParams(),
        ];
    }
}
