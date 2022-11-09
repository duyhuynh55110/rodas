<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class UserNotificationTransformer extends TransformerAbstract
{
    /**
     * Transform data
     *
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'content' => $data->content,
            'type' => $data->type,
        ];
    }
}
