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
     * @return League\Fractal\Resource\Collection
     */
    public function getUserNotifications()
    {
        $userId = auth()->user()->id;

        $data = $this->userNotificationRepo->getUserNotifications($userId);
        $collection = createFractalCollection($data, new UserNotificationTransformer);

        return $collection;
    }
}
