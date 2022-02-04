<?php
namespace app\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function promoteUser($user)
    {
        return $user->update(['role' => 1]);
    }

    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}