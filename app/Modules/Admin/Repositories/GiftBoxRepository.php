<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\GiftBox;

/**
 * GiftBoxRepository
 */
class GiftBoxRepository extends Repository
{
    /**
     * Model
     *
     * @return GiftBox::class
     */
    public function model()
    {
        return GiftBox::class;
    }

    /**
     * Get gift boxs and format dataTable response
     *
     * @param array $filters
     * @return Illuminate\Http\JsonResponse
     */
    public function giftBoxsDataTable(array $filters)
    {
        $query = $this->model->select(
            [
                'id',
                'name',
                'price',
                'image_file_name',
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

        return datatables($query)
        ->addColumn(
            'price',
            function ($giftBox) {
                return floatval($giftBox->price);
            }
        )
        ->escapeColumns([])->make(true);
    }

    /**
     * Create/Update gift box with relations
     *
     * Relations
     * - products (gift_box_products)
     *
     * @param array $attributes
     * @param array $values
     * @param array $giftBoxProducts
     * @return App\Models\GiftBox
     */
    public function updateOrCreateWithRelations(array $attributes,  array $values, array $giftBoxProducts)
    {
        // create/update a gift box
        $giftBox = $this->updateOrCreate($attributes, $values);

        $giftBoxProductsData = [];
        collect($giftBoxProducts)->map(
            function ($giftBoxProduct) use (&$giftBoxProductsData) {
                $values = collect($giftBoxProduct)->except(['product_id'])->all();
                $giftBoxProductsData[$giftBoxProduct['product_id']] = $values;
            }
        )->all();

        // create/update 'gift_box_products' rows for this gift box
        $giftBox->products()->sync($giftBoxProductsData);

        return $giftBox;
    }
}
