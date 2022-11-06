<?php

namespace App\Modules\Api\Repositories;

use App\Models\Product;
use Base\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

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
     * @param  array  $filter
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts($userId, array $filter)
    {
        $query = $this->model->select([
            'products.id',
            'products.brand_id',
            'products.name',
            'products.image_file_name',
            'products.description',
            'products.item_price',
            DB::raw('fp.id as is_favorite'),
        ])
        ->with(['brand:id,name,logo_file_name'])
        ->leftJoin('favorite_products as fp', function ($q) use ($userId) {
            $q->on('fp.product_id', '=', 'products.id')
            ->where('fp.user_id', '=', DB::raw($userId));
        });

        // filters
        $this->filterProducts($query, $filter);

        // paginate
        return $query->paginate(getPerPage());
    }

    /**
     * Filter products by condition
     *
     * @param $query
     * @param $filter
     * @return void
     */
    private function filterProducts($query, $filter)
    {
        // filter by search text
        $query->when(
            isset($filter['search']) && ! empty($filter['search']),
            function ($q) use ($filter) {
                $search = '%'.$filter['search'].'%';
                $q->where('products.name', 'like', $search);
            }
        );

        // filter by categories
        $query->when(
            isset($filter['category_ids']) && ! empty($filter['category_ids']),
            function ($q) use ($filter) {
                $q->whereHas('categories', function ($q) use ($filter) {
                    $q->whereIn('category_id', $filter['category_ids']);
                });
            }
        );

        // filter only get user's favorite products
        $query->when(
            isset($filter['is_favorite']) && $filter['is_favorite'],
            function ($q) {
                $q->whereNotNull('fp.id');
            }
        );
    }
}
