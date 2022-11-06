<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\ProductRepository;
use App\Modules\Api\Transformers\ProductTransformer;

class ProductService
{
    /**
     * Constructor
     *
     * @param  ProductRepository  $productRepo
     */
    public function __construct(private ProductRepository $productRepo)
    {
    }

    /**
     * Get products with paginate
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getProducts()
    {
        $data = $this->productRepo->getProducts();
        $collection = createFractalCollection($data, new ProductTransformer);

        return $collection;
    }
}
