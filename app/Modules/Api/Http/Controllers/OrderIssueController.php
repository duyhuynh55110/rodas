<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\CreateOrderIssueFormRequest;
use App\Modules\Api\Services\OrderIssueService;

class OrderIssueController extends BaseController
{
    /**
     * Constructor
     *
     * @param  OrderIssueService  $orderIssueServices
     */
    public function __construct(private OrderIssueService $orderIssueService)
    {
        parent::__construct();
    }

    /**
     * Create a order issue
     *
     * @param  CreateOrderIssueFormRequest  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function create(CreateOrderIssueFormRequest $request)
    {
        $orderIssue = $this->orderIssueService->createOrderIssue($request);

        return $this->outputJson($orderIssue);
    }
}
