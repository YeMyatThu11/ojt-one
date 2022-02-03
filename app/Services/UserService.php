<?php
namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Dao\UserDao;

class UserService implements UserServiceInterface
{
    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function getAllUsers()
    {
        return $this->userDao->getAllUsers();
    }

    public function updateUserProfile($data, $user)
    {
        return $this->userDao->updateUserProfile($data, $user);
    }

}