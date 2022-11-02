<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class GiftBoxTransformer extends TransformerAbstract
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
            'image_url' => $data->full_path_image,
        ];
    }
}
