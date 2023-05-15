<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class OrderIssueTransformer extends TransformerAbstract
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
            'status' => $data->status,
            'total_price' => $data->total_price,
        ];
    }
}
