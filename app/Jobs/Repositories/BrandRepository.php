<?php

namespace App\Jobs\Repositories;

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
}
