<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Http\Requests\LoginFormRequest;
use App\Modules\Api\Http\Requests\RegisterUserFormRequest;
use App\Modules\Api\Services\UserService;

class AuthController extends BaseController
{
    /**
     * Constructor
     *
     * @param  UserRepository  $userRepo
     */
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    /**
     * Register a user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserFormRequest $request)
    {
        $token = $this->userService->register($request);

        return $this->outputJson($token);
    }

    /**
     * Register a user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function login(LoginFormRequest $request)
    {
        $token = $this->userService->login($request);

        return $this->outputJson($token);
    }

    /**
     * Logout a user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->userService->logout();

        return $this->outputJson([]);
    }
}
