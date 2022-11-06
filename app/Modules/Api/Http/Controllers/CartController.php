<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\ProductService;

class CartController extends BaseController
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
     * Response user's products cart with paginate
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->productService->getProductsCart();

        return $this->outputJson($responseData);
    }
}
