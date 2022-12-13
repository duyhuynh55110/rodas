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
     * @param $filter
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserNotifications($userId, $filter)
    {
        $query = $this->model->select([
            'id',
            'title',
            'content',
            'type',
            'is_read',
            'created_at',
        ])
        ->where('user_id', $userId);

        // filter
        $this->filterUserNotifications($query, $filter);

        return $query->orderBy('id', 'DESC')->paginate(getPerPage());
    }


    /**
     * Filter user's notifications by condition
     *
     * @param $query
     * @param $filter
     * @return void
     */
    private function filterUserNotifications($query, $filter) {
        // filter by is_read
        $query->when(
            isset($filter['is_read']),
            function ($q) use ($filter) {
                $q->where('is_read', $filter['is_read']);
            }
        );

        // filter by type
        $query->when(
            isset($filter['type']) && ! empty($filter['type']),
            function ($q) use ($filter) {
                $q->where('type', $filter['type']);
            }
        );
    }
}
