<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\Country;

/**
 * CountryRepository
 */
class CountryRepository extends Repository
{
    /**
     * Model
     *
     * @return Country::class
     */
    public function model()
    {
        return Country::class;
    }

    /**
     * Get all countries
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getCountries()
    {
        return $this->model->select(
            [
                'id',
                'name',
            ]
        )->get();
    }
}
