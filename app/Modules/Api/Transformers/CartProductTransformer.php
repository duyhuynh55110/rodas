<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CartProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     */
    protected array $defaultIncludes = [
        'brand',
    ];

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
            'image_url' => $data->full_path_image,
            'item_price' => floatval($data->item_price),
            'is_favorite' => (bool) $data->is_favorite,
            'quantity' => $data->quantity,
        ];
    }

    /**
     * Include Brand
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeBrand($data)
    {
        return $this->item($data->brand, new BrandTransformer);
    }
}
