<?php

namespace App\Modules\Admin\Repositories;

use App\Models\Brand;
use Base\Repositories\Eloquent\Repository;

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
     * Get brands and format dataTable response
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function brandsDataTable(array $filter)
    {
        $query = $this->model->select(
            [
                'id',
                'name',
                'country_id',
                'logo_file_name',
            ]
        )->with(
            [
                'country:id,name',
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

        // filter by country_id
        $query->when(
            isset($filter['country_id']) && $filter['country_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filter) {
                return $q->where('country_id', $filter['country_id']);
            }
        );

        return datatables($query)->escapeColumns([])->make(true);
    }
}
