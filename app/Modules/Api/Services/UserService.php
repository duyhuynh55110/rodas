<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\UserRepository;
use App\Modules\Api\Transformers\UserTransformer;
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

            $data = $this->userRepo->createWithToken($values);

            $response = [
                'token_type' => TOKEN_TYPE_BEARER,
                'access_token' => $data['access_token'],
                'user' => createFractalItem($data['user'], new UserTransformer),
            ];

            // commit transaction
            DB::commit();

            return $response;
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollBack();

            // write log
            writeLogHandleException($e);

            throw $e;
        }
    }
}
