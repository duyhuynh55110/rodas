<?php

namespace App\Jobs\Services;

use App\Jobs\Repositories\BrandRepository;

class BrandService
{
    /**
     * __construct
     */
    public function __construct(private BrandRepository $brandRepo)
    {
    }

    /**
     * Get brand by id
     *
     * @return \App\Models\Brand
     */
    public function findBrandById($id)
    {
        return $this->brandRepo->findOrFail($id);
    }
}
