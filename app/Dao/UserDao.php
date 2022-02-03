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

    public function resetPassword($hash, $user)
    {
        $user->password = $hash;
        return $user->save();
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}