<?php

namespace App\Jobs\Repositories;

use App\Models\Product;
use Base\Repositories\Eloquent\Repository;

/**
 * ProductRepository
 */
class ProductRepository extends Repository
{
    /**
     * Model
     *
     * @return Product::class
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Get list products come from brand
     *
     * @param $brandId
     * @param $limit
     * @return
     */
    public function findTopProductsByBrand($brandId, $limit = 5) {
        $results = $this->model->where('brand_id', $brandId)->take($limit)->get();

        // reset model
        $this->resetModel();

        return $results;
    }
}
