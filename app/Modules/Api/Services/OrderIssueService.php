<?php

namespace App\Modules\Api\Services;

use App\Exceptions\EmptyCartProductsHttpException;
use App\Modules\Api\Repositories\OrderIssueRepository;
use App\Modules\Api\Repositories\ProductRepository;
use App\Modules\Api\Transformers\OrderIssueTransformer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderIssueService
{
    /**
     * Constructor
     *
     * @param  OrderIssueRepository  $orderIssueRepo
     * @param  ProductRepository  $productRepo
     */
    public function __construct(private OrderIssueRepository $orderIssueRepo, private ProductRepository $productRepo)
    {
    }

    /**
     * Create a order issue
     *
     * @param $request
     * @return \League\Fractal\Resource\Item
     */
    public function createOrderIssue($request)
    {
        try {
            // db - start transaction
            DB::beginTransaction();

            $user = auth()->user();

            // get products
            $cartProducts = $this->productRepo->getAllCartProducts($user->id);

            if (! $cartProducts->count()) {
                throw new EmptyCartProductsHttpException;
            }

            // order_issue_products values
            $orderIssueProducts = $cartProducts->map(function ($product) {
                $quantity = $product->quantity;
                $itemPrice = $product->item_price;

                return [
                    'product_id' => $product->id,
                    'item_price' => $itemPrice,
                    'quantity' => $quantity,
                    'amount' => $quantity * $itemPrice,
                ];
            });

            // order_issues values
            $orderIssueValues = [
                'user_id' => $user->id,
                'status' => ORDER_ISSUE_STATUS_UNCONFIRMED,
                'total_price' => $orderIssueProducts->sum('amount'),
                'note' => null,
            ];

            // order_issues_inform values
            $orderIssueInformValues = [
                'country_id' => $request->country_id,
                'name' => $request->name,
                'email' => $request->email,
                'zip_code' => $request->zip_code,
                'city' => $request->city,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            $orderIssue = $this->orderIssueRepo->createOrderIssue(
                $orderIssueValues,
                $orderIssueInformValues,
                $orderIssueProducts,
                $user
            );

            // db - end transaction and save data
            DB::commit();

            // fractal item
            $item = createFractalItem($orderIssue, new OrderIssueTransformer);

            return $item;
        } catch (Throwable $e) {
            // log error
            Log::error($e);

            // db rollback
            DB::rollback();

            // throw exception
            throw $e;
        }
    }
}
