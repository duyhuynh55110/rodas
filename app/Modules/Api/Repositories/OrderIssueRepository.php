<?php

namespace App\Modules\Api\Repositories;

use App\Models\OrderIssue;
use Base\Repositories\Eloquent\Repository;

/**
 * OrderIssueRepository
 */
class OrderIssueRepository extends Repository
{
    /**
     * Model
     *
     * @return OrderIssue::class
     */
    public function model()
    {
        return OrderIssue::class;
    }

    /**
     * Create a order issue
     *
     * @param array $orderIssueValues
     * @param array $orderIssueInformValues
     * @param $orderIssueProductsValues
     * @return \App\Models\OrderIssue
     */
    public function createOrderIssue(
        array $orderIssueValues,
        array $orderIssueInformValues,
        $orderIssueProducts
    ) {
        // create order issue
        $orderIssue = $this->model->create($orderIssueValues);

        // create order issue inform
        $orderIssue->orderIssueInform()->create($orderIssueInformValues);


        $orderIssueProductsValues = [];
        $orderIssueProducts->map(
            function ($orderIssueProduct) use (&$orderIssueProductsValues) {
                $values = collect($orderIssueProduct)->except(['product_id'])->all();
                $orderIssueProductsValues[$orderIssueProduct['product_id']] = $values;
            }
        );

        // create order issue products
        $orderIssue->orderIssueProducts()->sync($orderIssueProductsValues);

        return $orderIssue;
    }
}
