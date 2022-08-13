<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\BrandRepository;

/**
 * Brand Service
 */
class BrandService
{
    /**
     * @var Brand Repository
     */
    private $brandRepository;

    /**
     * __construct
     *
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
}
