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
     * Response user's cart products with paginate
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->productService->getCartProducts();

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
     * @param $id
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function delete($id, RemoveProductFromCartFormRequest $request)
    {
        $this->productService->removeProductFromCart($id);

        return $this->outputJson([]);
    }
}
