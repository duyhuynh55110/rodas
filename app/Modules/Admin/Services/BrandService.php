<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\BrandRepository;
use Illuminate\Http\Request;

/**
 * Brand Service
 */
class BrandService
{
    /**
     * @var Brand Repository
     */
    private $brandRepo;

    /**
     * __construct
     *
     * @param BrandRepository $brandRepo
     */
    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    /**
     * Data for brands table
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function brandsDataTable(Request $request)
    {
        $filters = [
            'name' => $request->name ?? null,
            'country_id' => $request->country_id ?? null,
        ];

        return $this->brandRepo->brandsDataTable($filters);
    }
}
