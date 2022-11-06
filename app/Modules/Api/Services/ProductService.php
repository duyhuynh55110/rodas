<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\ProductRepository;
use App\Modules\Api\Transformers\CartProductTransformer;
use App\Modules\Api\Transformers\ProductTransformer;

class ProductService
{
    /**
     * Constructor
     *
     * @param  ProductRepository  $productRepo
     */
    public function __construct(private ProductRepository $productRepo)
    {
    }

    /**
     * Get products with paginate
     *
     * @param $request
     * @return League\Fractal\Resource\Collection
     */
    public function getProducts($request)
    {
        $userId = auth()->user()->id;
        $filters = [
            'search' => $request->search,
            'category_ids' => $request->category_ids,
            'is_favorite' => $request->is_favorite,
        ];
        $data = $this->productRepo->getProducts($userId, $filters);
        $collection = createFractalCollection($data, new ProductTransformer);

        return $collection;
    }

    /**
     * Get user's products cart
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getProductsCart()
    {
        $userId = auth()->user()->id;
        $data = $this->productRepo->getProductsCart($userId);
        $collection = createFractalCollection($data, new CartProductTransformer);

        return $collection;
    }
}
