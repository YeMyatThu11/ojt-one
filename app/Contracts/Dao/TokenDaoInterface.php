<?php
namespace App\Contracts\Dao;

interface TokenDaoInterface
{
    public function findTokenFromTable($tableName, $data);
    public function deleteTokenFromTable($tableName, $data);
    public function addTokenToTable($tableName, $data);
}