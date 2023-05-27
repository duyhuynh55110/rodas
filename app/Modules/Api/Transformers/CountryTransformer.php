<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
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
            'calling_code' => $data->calling_code,
        ];
    }
}
