<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\CreateFavoriteProductFormRequest;
use App\Modules\Api\Http\Requests\RemoveFavoriteProductFormRequest;
use App\Modules\Api\Services\ProductService;

class FavoriteController extends BaseController
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
     * Response user's favorite products with paginate
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->productService->getFavoriteProducts();

        return $this->outputJson($responseData);
    }

    /**
     * Add a user's favorite product
     *
     * @param $id products.id
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function create($id, CreateFavoriteProductFormRequest $request)
    {
        $product = $this->productService->createFavoriteProduct($id);

        return $this->outputJson($product);
    }

    /**
     * Remove a user's favorite product
     *
     * @param $id products.id
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function delete($id, RemoveFavoriteProductFormRequest $request)
    {
        $product = $this->productService->removeFavoriteProduct($id);

        return $this->outputJson($product);
    }
}
