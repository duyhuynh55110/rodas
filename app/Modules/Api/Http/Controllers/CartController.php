<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\CreateProductToCartFormRequest;
use App\Modules\Api\Http\Requests\RemoveProductFromCartFormRequest;
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

    /**
     * Add/Update a product to cart
     *
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function updateOrCreate(CreateProductToCartFormRequest $request)
    {
        $this->productService->updateOrCreateProductToCart($request);

        return $this->outputJson([]);
    }

    /**
     * Remove a product from cart
     *
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function delete(RemoveProductFromCartFormRequest $request)
    {
        $this->productService->removeProductFromCart($request);

        return $this->outputJson([]);
    }
}
