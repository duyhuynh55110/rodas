<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    /**
     * Transform data
     *
     * @return array
     */
    public function transform($data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
            'logo_url' => $data->full_path_logo,
        ];
    }
}
