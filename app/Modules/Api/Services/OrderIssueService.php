<?php

namespace App\Modules\Api\Services;

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
     * @param  ProductRepository $productRepo
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
    public function createOrderIssue($request) {
        try {
            // db - start transaction
            DB::beginTransaction();

            // request
            $orderProductsRequest = collect($request->order_products);
            $orderProductIds = $orderProductsRequest->pluck('id')->all();

            // get products
            $products = $this->productRepo->getProductByIds($orderProductIds, ['id', 'item_price']);

            // order_issue_products values
            $orderIssueProducts = $orderProductsRequest->map(function($orderProduct) use ($products) {
                $productId = $orderProduct['id'];
                $quantity = $orderProduct['quantity'];
                $itemPrice = $products->where('id', $productId)->first()->item_price;

                return [
                    'product_id' => $productId,
                    'item_price' => $itemPrice,
                    'quantity' => $quantity,
                    'amount' => $quantity * $itemPrice,
                ];
            });

            // order_issues values
            $orderIssueValues = [
                'user_id' => auth()->user()->id,
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
                'phone' =>  $request->phone,
                'address' => $request->address,
            ];

            $orderIssue = $this->orderIssueRepo->createOrderIssue(
                $orderIssueValues,
                $orderIssueInformValues,
                $orderIssueProducts
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
