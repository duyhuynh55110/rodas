<?php

namespace App\Modules\Api\Repositories;

use App\Models\User;
use Base\Repositories\Eloquent\Repository;

/**
 * UserRepository
 */
class UserRepository extends Repository
{
    /**
     * Model
     *
     * @return User::class
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Register a user and their token
     *
     * @param  array  $values
     * @return array
     */
    public function registerUser(array $values)
    {
        $user = $this->model->create($values);

        // response access_token, user info
        $data = $this->createUserLoginToken($user);

        return $data;
    }

    /**
     * Create token when user login by API
     *
     * @param  User  $user
     * @return array
     */
    public function createUserLoginToken(User $user)
    {
        // create user token (use to login)
        $plainTextToken = $user->createToken(TOKEN_NAME_API)->plainTextToken;

        // explode plainTextToken
        [$tokenId, $accessToken] = explode('|', $plainTextToken);

        return [
            'access_token' => $accessToken,
            'user' => $user,
        ];
    }

    /**
     * Create/Update product to user's cart
     *
     * @param  User  $user
     * @param $productId
     * @param $cartProductValues
     * @param $type
     * @return void
     */
    public function updateOrCreateCartProduct(User $user, $productId, $cartProductValues, $type)
    {
        $cartProducts = $user->cartProducts();
        $cartProduct = $cartProducts->where('product_id', $productId)->first();

        if ($cartProduct) {
            // if type was update
            if ($type == ADD_TO_CART_TYPE_INSERT) {
                $currentQuantity = $cartProduct->pivot->quantity;
                $cartProductValues['quantity'] += $currentQuantity;
            }

            $cartProducts->updateExistingPivot($productId, $cartProductValues);
        } else {
            // create/update products in cart
            $cartProducts->attach([
                $productId => $cartProductValues,
            ]);
        }
    }

    /**
     * Remove product from user's cart
     *
     * @param  User  $user
     * @param $productId
     * @return void
     */
    public function removeCartProduct(User $user, $productId)
    {
        $cartProducts = $user->cartProducts();
        $productExists = $cartProducts->where('product_id', $productId)->exists();

        if ($productExists) {
            $cartProducts->detach([$productId]);
        }
    }

    /**
     * Create a favorite product
     *
     * @param  User  $user
     * @param $productId
     * @return void
     */
    public function createFavoriteProduct(User $user, $productId)
    {
        $favoriteProducts = $user->favoriteProducts();
        $productExists = $favoriteProducts->where('product_id', $productId)->exists();

        // create if not exists
        if (! $productExists) {
            $favoriteProducts->attach([$productId]);
        }
    }

    /**
     * Remove a favorite product
     *
     * @param  User  $user
     * @param $productId
     * @return void
     */
    public function removeFavoriteProduct(User $user, $productId)
    {
        $favoriteProducts = $user->favoriteProducts();
        $productExists = $favoriteProducts->where('product_id', $productId)->exists();

        // remove if exists
        if ($productExists) {
            $favoriteProducts->detach([$productId]);
        }
    }
}
