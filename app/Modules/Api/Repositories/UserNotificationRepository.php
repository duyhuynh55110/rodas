<?php

namespace App\Modules\Api\Repositories;

use App\Models\UserNotification;
use Base\Repositories\Eloquent\Repository;

/**
 * UserNotificationRepository
 */
class UserNotificationRepository extends Repository
{
    /**
     * Model
     *
     * @return UserNotification::class
     */
    public function model()
    {
        return UserNotification::class;
    }

    /**
     * Get notifications with paginate
     *
     * @param $userId
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserNotifications($userId)
    {
        return $this->model->select([
            'id',
            'title',
            'content',
            'type',
        ])
        ->where('user_id', $userId)
        ->paginate(getPerPage());
    }
}
