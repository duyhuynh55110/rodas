<?php

namespace App\Jobs\Services;

use App\Jobs\Repositories\ProductRepository;

class ProductService {
    /**
     * __construct
     *
     * @param  ProductRepository $productRepo
     */
    public function __construct(private ProductRepository $productRepo)
    {
    }

    /**
     * Get list products come from brand
     *
     * @param $brandId
     */
    public function findTopProductsByBrand($brandId) {
        return $this->productRepo->findTopProductsByBrand($brandId);
    }
}
