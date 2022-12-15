<?php

namespace App\Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'is_read' => [
                'integer',
                Rule::in([NOTIFICATION_IS_READ_OFF, NOTIFICATION_IS_READ_ON])
            ],
            'type' => [
                'integer',
                Rule::in([NOTIFICATION_TYPE_NORMAL, NOTIFICATION_TYPE_SUCCESS])
            ],

            // paginate
            ...validatePaginationRequestParams(),
        ];
    }
}
