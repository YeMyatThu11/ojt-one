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

    public function resetPassword($hash, $user)
    {
        return $this->userDao->resetPassword($hash, $user);
    }
    public function deleteUser($user)
    {
        return $this->userDao->deleteUser($user);
    }
    public function changeRole($user)
    {
        return $this->userDao->changeRole($user);
    }
    public function createUser($data)
    {
        return $this->userDao->createUser($data);
    }
    public function updateUserPassword($email, $password)
    {
        return $this->userDao->updateUserPassword($email, $password);
    }
    public function userVerified($userId)
    {
        return $this->userDao->userVerified($userId);
    }

}