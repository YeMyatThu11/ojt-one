<?php
namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function getAllUsers();
    public function updateUserProfile($data, $user);
}