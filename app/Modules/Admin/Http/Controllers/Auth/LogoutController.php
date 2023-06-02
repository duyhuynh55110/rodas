<?php

namespace App\Modules\Admin\Http\Controllers\Auth;

use App\Modules\Admin\Http\Controllers\BaseController;

/**
 * Logout controller
 */
class LogoutController extends BaseController
{
    /**
     * Logout user
     *
     * @return void
     */
    public function logout()
    {
        // logout user
        auth()->logout();

        // redirect to login form
        return redirect()->action([LoginController::class, 'login']);
    }
}
