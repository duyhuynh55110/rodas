<?php

namespace App\Modules\Api\Repositories;

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
     * Get products with paginate
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts()
    {
        return $this->model->select([
            'id',
            'brand_id',
            'name',
            'image_file_name',
            'description',
            'item_price',
        ])
        ->with(['brand:id,name,logo_file_name'])
        ->paginate();
    }
}
