<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\Brand;

/**
 * BrandRepository
 */
class BrandRepository extends Repository
{
    /**
     * Model
     *
     * @return Brand::class
     */
    public function model()
    {
        return Brand::class;
    }

    /**
     * Get brands and format datatable response
     *
     * @param array $filters
     * @return
     */
    public function datatableBrands(array $filters)
    {
        $query = $this->model->select(
            [
                'id',
                'name',
            ]
        );

        return datatables($query)->escapeColumns([])->make(true);
    }
}
