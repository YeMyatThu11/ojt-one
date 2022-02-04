<?php
namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function getAllUsers();
    public function updateUserProfile($data, $user);
    public function resetPassword($hash, $user);
    public function deleteUser($user);
    public function promoteUser($user);
    public function createUser($data);
}