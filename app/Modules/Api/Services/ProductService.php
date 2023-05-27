<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\ProductRepository;
use App\Modules\Api\Repositories\UserRepository;
use App\Modules\Api\Transformers\CartProductTransformer;
use App\Modules\Api\Transformers\ProductTransformer;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ProductService
{
    /**
     * Constructor
     *
     * @param  ProductRepository  $productRepo
     * @param  UserRepository  $userRepo
     */
    public function __construct(
        private ProductRepository $productRepo,
        private UserRepository $userRepo
    ) {
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
     * Get user's cart products
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getCartProducts()
    {
        $userId = auth()->user()->id;
        $data = $this->productRepo->getCartProducts($userId);
        $collection = createFractalCollection($data, new CartProductTransformer);

        return $collection;
    }

    /**
     * Add/Update a product to user's cart
     *
     * @param $request
     * @return void
     */
    public function updateOrCreateProductToCart($request)
    {
        try {
            $user = auth()->user();
            $productId = $request->product_id;
            $type = $request->type;

            // cart_products value
            $cartProductValues = [
                'quantity' => $request->quantity,
            ];

            // start transaction
            DB::beginTransaction();

            // create/update cart_product
            $this->userRepo->updateOrCreateCartProduct($user, $productId, $cartProductValues, $type);

            // commit transaction
            DB::commit();
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollback();

            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * Remove a product from user's cart
     *
     * @param $productId
     * @return void
     */
    public function removeProductFromCart($productId)
    {
        try {
            $user = auth()->user();

            // start transaction
            DB::beginTransaction();

            // create/update cart_product
            $this->userRepo->removeCartProduct($user, $productId);

            // commit transaction
            DB::commit();
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollback();

            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * Get user's favorite products
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getFavoriteProducts()
    {
        $userId = auth()->user()->id;
        $filter = [
            'is_favorite' => true,
        ];

        $data = $this->productRepo->getProducts($userId, $filter);
        $collection = createFractalCollection($data, new ProductTransformer);

        return $collection;
    }

    /**
     * Create a favorite product
     *
     * @param $request
     * @return void
     */
    public function createFavoriteProduct($productId)
    {
        try {
            $user = auth()->user();

            // start transaction
            DB::beginTransaction();

            // create/update cart_product
            $this->userRepo->createFavoriteProduct($user, $productId);

            // commit transaction
            DB::commit();

            // fractal format
            $item = $this->getProductById($productId, $user->id);

            return $item;
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollback();

            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * Remove a favorite product
     *
     * @param $productId
     * @return void
     */
    public function removeFavoriteProduct($productId)
    {
        try {
            $user = auth()->user();

            // start transaction
            DB::beginTransaction();

            // create/update cart_product
            $this->userRepo->removeFavoriteProduct($user, $productId);

            // commit transaction
            DB::commit();

            // fractal format
            $item = $this->getProductById($productId, $user->id);

            return $item;
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollback();

            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * Get a product detail by id
     *
     * @param $productId
     * @param $userId
     * @return League\Fractal\Resource\Item
     */
    public function getProductById($productId)
    {
        $userId = auth()->user()->id;
        $product = $this->productRepo->getProductById($productId, $userId);

        if(!$product) {
            throw new NotFoundHttpException();
        }

        // fractal item
        $item = createFractalItem($product, new ProductTransformer);

        return $item;
    }
}
