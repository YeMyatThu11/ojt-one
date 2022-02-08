<?php
namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function getAllUsers();
    public function updateUserProfile($data, $user);
    public function resetPassword($hash, $user);
    public function deleteUser($user);
    public function changeRole($user);
    public function createUser($data);
    public function updateUserPassword($email, $password);
    public function userVerified($userId);
}