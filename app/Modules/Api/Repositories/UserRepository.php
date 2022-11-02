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
}
