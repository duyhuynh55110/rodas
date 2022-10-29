<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Modules\Api\Http\Controllers\BaseController;
use App\Modules\Api\Http\Requests\RegisterUserFormRequest;

class RegisterController extends BaseController
{
    /**
     * Register a user
     *
     * @param  RegisterUserFormRequest  $request
     */
    public function register(RegisterUserFormRequest $request)
    {
        dd($request->all());
    }
}
