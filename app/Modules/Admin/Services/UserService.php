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
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate attempt
     *
     * @param array $credentials credentials.
     * @return boolean
     */
    public function authenticate(array $credentials): bool
    {
        return (authAdmin()->attempt($credentials));
    }
}
