<?php

namespace App\Modules\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     */
    protected array $availableIncludes = [
        'product_slides',
    ];

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
            'description' => $data->description,
            'item_price' => floatval($data->item_price),
            'is_favorite' => (bool) $data->is_favorite,
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

    /**
     * Include product slides
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeProductSlides($data)
    {
        if (! $data->productSlides) {
            return null;
        }

        return $this->collection($data->productSlides, new ProductSlideTransformer);
    }
}
