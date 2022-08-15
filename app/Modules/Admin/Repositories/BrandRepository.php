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
     * Get brands and format dataTable response
     *
     * @param array $filters
     * @return Illuminate\Http\JsonResponse
     */
    public function brandsDataTable(array $filters)
    {
        $query = $this->model->select(
            [
                'id',
                'name',
                'country_id',
                'logo_file_name'
            ]
        )->with(
            [
                'country:id,name'
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

        // filter by country_id
        $query->when(
            isset($filters['country_id']) && $filters['country_id'] != SELECT_OPTION_ALL,
            function ($q) use ($filters) {
                return $q->where('country_id', $filters['country_id']);
            }
        );

        return datatables($query)->escapeColumns([])->make(true);
    }
}
