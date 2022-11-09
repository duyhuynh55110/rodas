<?php

namespace App\Modules\Api\Repositories;

use App\Models\CartProduct;
use Base\Repositories\Eloquent\Repository;

/**
 * CartProductRepository
 */
class CartProductRepository extends Repository
{
    /**
     * Model
     *
     * @return CartProduct::class
     */
    public function model()
    {
        return CartProduct::class;
    }
}
