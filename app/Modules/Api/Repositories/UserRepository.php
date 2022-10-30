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
     * Register a user with token
     *
     * @param  array  $values
     * @return \App\Models\User
     */
    public function createWithToken(array $values)
    {
        $user = $this->model->create($values);

        $token = $user->createToken(TOKEN_NAME_API);

        return [
            'access_token' => $token->plainTextToken,
        ];
    }
}
