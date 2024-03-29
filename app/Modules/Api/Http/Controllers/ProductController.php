<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\ProductDetailFormRequest;
use App\Modules\Api\Http\Requests\ProductsListFormRequest;
use App\Modules\Api\Services\ProductService;

class ProductController extends BaseController
{
    /**
     * Constructor
     */
    public function __construct(private ProductService $productService)
    {
        parent::__construct();
    }

    /**
     * Response products with paginate
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(ProductsListFormRequest $request)
    {
        $responseData = $this->productService->getProducts($request);

        return $this->outputJson($responseData);
    }

    /**
     * Response a product detail by id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id, ProductDetailFormRequest $request)
    {
        $product = $this->productService->getProductById($id);

        $this->fractal->parseIncludes(['product_slides']);

        return $this->outputJson($product);
    }
}
