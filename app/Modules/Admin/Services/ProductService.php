<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\ProductRepository;
use Illuminate\Http\Request;

/**
 * ProductService
 */
class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepo;

    /**
     * __construct
     *
     * @param ProductRepository $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Data for products table
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function productsDataTable(Request $request)
    {
        $filters = [
            'name' => $request->name ?? null,
            'brand_id' => $request->brand_id ?? null,
            'country_id' => $request->country_id ?? null,
        ];

        return $this->productRepo->productsDataTable($filters);
    }
}
