<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class EmptyCartProductsHttpException extends HttpException {
    /**
     * __constructor
     *
     * @return void
     */
    public function __construct($message = 'your cart is empty', $statusCode = STATUS_CODE_EMPTY_CART_PRODUCTS)
    {
        parent::__construct($statusCode, $message);
    }
}
