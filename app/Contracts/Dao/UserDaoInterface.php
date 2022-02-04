<?php
namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function getAllUsers();
    public function updateUserProfile($data, $user);
    public function resetPassword($hash, $user);
    public function deleteUser($user);
    public function promoteUser($user);
    public function createUser($data);
}