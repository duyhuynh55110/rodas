<?php

namespace App\Modules\Admin\Repositories;

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
     * Get products and format dataTable response
     *
     * @param  array  $filter
     * @return Illuminate\Http\JsonResponse
     */
    public function productsDataTable(array $filter)
    {
        $query = $this->model->select(
            [
                'id',
                'brand_id',
                'name',
                'image_file_name',
                'item_price',
            ]
        )->with(
            [
                'brand' => function ($q) {
                    $q->select('id', 'name', 'country_id')
                    ->with(['country:id,name']);
                },
            ]
        );

        // filter by name
        $query->when(
            isset($filter['name']),
            function ($q) use ($filter) {
                $name = '%'.$filter['name'].'%';

                return $q->where('name', 'LIKE', $name);
            }
        );

        // filter by brand_id
        $query->when(
            isset($filter['brand_id']) && $filter['brand_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filter) {
                return $q->where('brand_id', $filter['brand_id']);
            }
        );

        // filter by country_id
        $query->when(
            isset($filter['country_id']) && $filter['country_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filter) {
                return $q->whereHas('brand', function ($q2) use ($filter) {
                    $q2->where('country_id', $filter['country_id']);
                });
            }
        );

        return datatables($query)
            ->addColumn('item_price', function ($product) {
                return floatval($product->item_price);
            })
            ->escapeColumns([])->make(true);
    }

    /**
     * Create/Update product with relations
     *
     * Relations
     * - categories
     *
     * @param  array  $attributes
     * @param  array  $values
     * @param  array  $categoriesData
     * @return App\Models\Product
     */
    public function updateOrCreateWithRelations(array $attributes, array $values, array $categoriesData)
    {
        // create/update a product
        $product = $this->updateOrCreate($attributes, $values);

        // Laravel pivot sync function - compare change to create/update/delete relation data
        $product->categories()->sync($categoriesData);

        return $product;
    }
}
