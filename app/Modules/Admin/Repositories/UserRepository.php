<?php

namespace App\Modules\Admin\Repositories;

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
}
