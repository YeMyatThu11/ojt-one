<?php
namespace app\Dao;

use App\Contracts\Dao\TokenDaoInterface;
use DB;

class TokenDao implements TokenDaoInterface
{
    public function findTokenFromTable($tableName, $data)
    {
        return DB::table($tableName)->where($data)->first();
    }
    public function deleteTokenFromTable($tableName, $data)
    {
        return DB::table($tableName)->where($data)->delete();
    }
    public function addTokenToTable($tableName, $data)
    {
        return DB::table($tableName)->insert($data);
    }
}