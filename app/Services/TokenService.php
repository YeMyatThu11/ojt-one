<?php
namespace App\Services;

use App\Contracts\Services\TokenServiceInterface;
use App\Dao\TokenDao;

class TokenService implements TokenServiceInterface
{
    private $TokenDao;
    public function __construct(TokenDao $TokenDao)
    {
        $this->TokenDao = $TokenDao;
    }

    public function findTokenFromTable($tableName, $data)
    {
        return $this->TokenDao->findTokenFromTable($tableName, $data);
    }

    public function deleteTokenFromTable($tableName, $data)
    {
        return $this->TokenDao->deleteTokenFromTable($tableName, $data);
    }
    public function addTokenToTable($tableName, $data)
    {
        return $this->TokenDao->addTokenToTable($tableName, $data);
    }

}