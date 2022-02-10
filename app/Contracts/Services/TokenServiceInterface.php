<?php
namespace App\Contracts\Services;

interface TokenServiceInterface
{
    public function findTokenFromTable($tableName, $data);
    public function deleteTokenFromTable($tableName, $data);
    public function addTokenToTable($tableName, $data);
}