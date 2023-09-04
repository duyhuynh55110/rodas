<?php

namespace App\Jobs\Services;

use App\Jobs\Repositories\ProductRepository;

class ProductService
{
    /**
     * __construct
     */
    public function __construct(private ProductRepository $productRepo)
    {
    }

    /**
     * Get list products come from brand
     */
    public function findTopProductsByBrand($brandId)
    {
        return $this->productRepo->findTopProductsByBrand($brandId);
    }
}
