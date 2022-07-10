<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\User;

/**
 * User Repository
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
}
