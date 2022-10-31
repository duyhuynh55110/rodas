<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Modules\Api\Http\Controllers\BaseController;
use App\Modules\Api\Http\Requests\RegisterUserFormRequest;
use App\Modules\Api\Services\UserService;

class RegisterController extends BaseController
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
     * @param  RegisterUserFormRequest  $request
     */
    public function register(RegisterUserFormRequest $request)
    {
        $token = $this->userService->register($request);

        return $this->outputJson($token);
    }
}
