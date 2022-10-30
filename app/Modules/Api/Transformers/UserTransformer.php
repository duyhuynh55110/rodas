<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
            'name' => $data->name,
            'email' => $data->email,
        ];
    }
}
