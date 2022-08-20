<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\User;

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
}
