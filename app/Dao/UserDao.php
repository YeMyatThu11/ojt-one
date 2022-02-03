<?php
namespace app\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;

class UserDao implements UserDaoInterface
{
    public function getAllUsers()
    {
        return User::paginate(30);
    }
    public function updateUserProfile($data, $user)
    {
        return $user->update($data);
    }
}