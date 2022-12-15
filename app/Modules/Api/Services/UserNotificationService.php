<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\UserNotificationRepository;
use App\Modules\Api\Transformers\UserNotificationTransformer;

class UserNotificationService
{
    /**
     * Constructor
     *
     * @param  UserNotificationRepository  $userNotificationRepo
     */
    public function __construct(private UserNotificationRepository $userNotificationRepo)
    {
    }

    /**
     * Get all user's notifications, fractal collection format
     *
     * @param $request
     * @return League\Fractal\Resource\Collection
     */
    public function getUserNotifications($request)
    {
        // current user's id
        $userId = auth()->user()->id;

        // filter data
        $filter = [
            'is_read' => $request->is_read,
            'type' => $request->type,
        ];

        $data = $this->userNotificationRepo->getUserNotifications($userId, $filter);
        $collection = createFractalCollection($data, new UserNotificationTransformer);

        return $collection;
    }
}
