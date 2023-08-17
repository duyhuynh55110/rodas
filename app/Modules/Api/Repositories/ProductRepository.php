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

        // sort by
        $query->orderBy('products.id', 'DESC');

        // paginate
        return $query->paginate(getPerPage());
    }

    /**
     * Filter products by condition
     *
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

    /**
     * Get user's cart products
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getCartProducts($userId)
    {
        $query = $this->model->select([
            'products.id',
            'products.brand_id',
            'products.name',
            'products.image_file_name',
            'products.item_price',
            DB::raw('fp.id as is_favorite'),
            'cp.quantity',
        ])
            ->with(['brand:id,name,logo_file_name'])
            ->join('cart_products as cp', function ($q) use ($userId) {
                $q->on('cp.product_id', '=', 'products.id')
                    ->where('cp.user_id', '=', DB::raw($userId));
            })
            ->leftJoin('favorite_products as fp', function ($q) use ($userId) {
                $q->on('fp.product_id', '=', 'products.id')
                    ->where('fp.user_id', '=', DB::raw($userId));
            });

        // paginate
        return $query->paginate(getPerPage());
    }

    /**
     * Get a product by id
     *
     * @return \App\Models\Product
     */
    public function getProductById($productId, $userId = null)
    {
        $select = [
            'products.id',
            'products.brand_id',
            'products.name',
            'products.image_file_name',
            'products.description',
            'products.item_price',
            ...($userId) ? [DB::raw('fp.id as is_favorite')] : [],
        ];

        $query = $this->model->select($select)->with([
            'brand:id,name,logo_file_name',
            'productSlides:product_id,image_file_name',
        ]);

        // if have user logged in check favorite
        $query->when(
            isset($userId) && ! empty($userId),
            function ($q) use ($userId) {
                $q->leftJoin('favorite_products as fp', function ($q) use ($userId) {
                    $q->on('fp.product_id', '=', 'products.id')
                        ->where('fp.user_id', '=', DB::raw($userId));
                });
            }
        );

        return $query->find($productId);
    }

    /**
     * Get all cart products
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllCartProducts($userId)
    {
        $query = $this->model->select([
            'products.id',
            'products.item_price',
            'cp.quantity',
        ])
            ->join('cart_products as cp', function ($q) use ($userId) {
                $q->on('cp.product_id', '=', 'products.id')
                    ->where('cp.user_id', '=', DB::raw($userId));
            });

        return $query->get();
    }
}
