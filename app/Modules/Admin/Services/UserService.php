<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\UserRepository;

/**
 * UserService
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * __construct
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate attempt
     *
     * @param  array  $credentials credentials.
     */
    public function authenticate(array $credentials): bool
    {
        return auth()->attempt($credentials);
    }
}
