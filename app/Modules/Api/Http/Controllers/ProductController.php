<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\ProductService;

class ProductController extends BaseController
{
    /**
     * Constructor
     *
     * @param  ProductService  $productService
     */
    public function __construct(private ProductService $productService)
    {
        parent::__construct();
    }

    /**
     * Response all categories
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->productService->getProducts();

        return $this->outputJson($responseData);
    }
}
