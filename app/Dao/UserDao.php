<?php
namespace app\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Carbon\Carbon;
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

    public function changeRole($user)
    {
        $role = $user->role == 1 ? $user->role + 1 : $user->role - 1;
        return $user->update(['role' => $role]);
    }

    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getUserById($userId)
    {
        return User::find($userId);
    }

    public function updateUserPassword($email, $password)
    {
        return User::where('email', $email)->update(['password' => Hash::make($password)]);
    }

    public function userVerified($userId)
    {
        return $user = User::where('id', $userId)->update(
            [
                'verified' => true,
                'email_verified_at' => Carbon::now(),
            ]);
    }
}