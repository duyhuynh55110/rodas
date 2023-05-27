<?php

namespace App\Modules\Api\Services;

use App\Exceptions\AuthenticateHttpException;
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
     * @param $request
     * @return array
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
                'role' => ACCOUNT_ROLE_USER,
            ];

            // register & login user
            $data = $this->userRepo->registerUser($values);

            // commit transaction
            DB::commit();

            return [
                'token_type' => TOKEN_TYPE_BEARER,
                'access_token' => $data['access_token'],
                'user' => createFractalItem($data['user'], new UserTransformer),
            ];
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollBack();

            // write log
            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * User login using email & password
     *
     * @param $request
     * @return mixed
     */
    public function login($request)
    {
        try {
            // begin transaction
            DB::beginTransaction();

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'role' => ACCOUNT_ROLE_USER,
            ];

            if (! auth()->attempt($credentials)) {
                throw new AuthenticateHttpException(STATUS_CODE_LOGIN_FAILED);
            }

            $user = auth()->user();

            // login user
            $data = $this->userRepo->createUserLoginToken($user);

            // commit transaction
            DB::commit();

            return [
                'token_type' => TOKEN_TYPE_BEARER,
                'access_token' => $data['access_token'],
                'user' => createFractalItem($data['user'], new UserTransformer),
            ];
        } catch (Throwable $e) {
            // rollback transaction
            DB::rollBack();

            // write log
            writeLogHandleException($e);

            throw $e;
        }
    }

    /**
     * Logout a user
     *
     * @return void
     */
    public function logout()
    {
        // get user -> must get type was 'sanctum' because this was out middleware 'auth:sanctum'
        $user = auth('sanctum')->user();

        if (! $user) {
            throw new AuthenticateHttpException();
        }

        // Revoke the user's current token...
        $user->currentAccessToken()->delete();
    }

    /**
     * Get user's profile
     *
     * @return @return League\Fractal\Resource\Item
     */
    public function profile()
    {
        $user = auth()->user();

        // fractal item
        $item = createFractalItem($user, new UserTransformer);

        return $item;
    }
}
