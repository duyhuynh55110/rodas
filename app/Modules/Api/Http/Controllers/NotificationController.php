<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\NotificationsListFormRequest;
use App\Modules\Api\Services\UserNotificationService;

class NotificationController extends BaseController
{
    /**
     * Constructor
     *
     * @param  UserNotificationService $userNotificationService
     */
    public function __construct(private UserNotificationService $userNotificationService)
    {
        parent::__construct();
    }

    /**
     * Response all categories
     *
     * @param $request
     * @return Illuminate\Http\JsonResponse
     */
    public function index(NotificationsListFormRequest $request)
    {
        $userNotifications = $this->userNotificationService->getUserNotifications();

        return $this->outputJson($userNotifications);
    }
}
