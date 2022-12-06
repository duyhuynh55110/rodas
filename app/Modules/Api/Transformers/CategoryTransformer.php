<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * Transform data
     *
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        $response = [
            'id' => $data->id,
            'name' => $data->name,
            'products_count' => $data->products_count,
        ];

        return $response;
    }
}
