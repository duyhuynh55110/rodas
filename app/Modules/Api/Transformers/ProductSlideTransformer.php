<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ProductSlideTransformer extends TransformerAbstract
{
    /**
     * Transform data
     *
     * @return array
     */
    public function transform($data)
    {
        return [
            'image_url' => $data->full_path_image,
        ];
    }
}
