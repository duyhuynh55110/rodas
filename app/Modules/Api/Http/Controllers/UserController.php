<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\UserService;

class UserController extends BaseController
{
    /**
     * Constructor
     *
     * @param  UserService  $userService
     */
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * Response user's profile
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = $this->userService->profile();

        return $this->outputJson($user);
    }
}
