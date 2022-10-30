<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserService
{
    /**
     * Constructor
     *
     * @param  UserRepository  $userRepo
     */
    public function __construct(private UserRepository $userRepo)
    {
    }

    /**
     * Create a user with token
     *
     * @param
     */
    public function register($request)
    {
        try {
            // begin transaction
            DB::beginTransaction();

            $values = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $token = $this->userRepo->createWithToken($values);

            // commit transaction
            DB::commit();

            return $token;
        } catch (Throwable $e) {
            writeLogHandleException($e);
        }
    }
}
