<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\Product;

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
     * Get products and format dataTable response
     *
     * @param array $filters
     * @return Illuminate\Http\JsonResponse
     */
    public function productsDataTable(array $filters)
    {
        $query = $this->model->select(
            [
                'id',
                'brand_id',
                'name',
                'image_file_name',
                'item_price',
                'weight',
            ]
        )->with(
            [
                'brand' => function ($q) {
                    $q->select('id', 'name', 'country_id')
                    ->with(['country:id,name']);
                }
            ]
        );

        // filter by name
        $query->when(
            isset($filters['name']),
            function ($q) use ($filters) {
                $name = '%' . $filters['name'] . '%';
                return $q->where('name', 'LIKE', $name);
            }
        );

        // filter by brand_id
        $query->when(
            isset($filters['brand_id']) && $filters['brand_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filters) {
                return $q->where('brand_id', $filters['brand_id']);
            }
        );

        // filter by country_id
        $query->when(
            isset($filters['country_id']) && $filters['country_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filters) {
                return $q->whereHas('brand', function ($q2) use ($filters) {
                    $q2->where('country_id', $filters['country_id']);
                });
            }
        );

        return datatables($query)
            ->addColumn('item_price', function($product) {
                return floatval($product->item_price);
            })
            ->escapeColumns([])->make(true);
    }
}
