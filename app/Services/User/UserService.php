<?php

namespace App\Services\User;

use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepository;
use App\Services\ServiceInterface;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService implements ServiceInterface
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return BaseRepository
     */
    public function repository(): BaseRepository
    {
        return $this->userRepository;
    }
}
