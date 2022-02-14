<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function getAllUser()
    {
        $users = $this->userService->getAllUsers();
        dd('aa');
        // return new UserResource::collection($users);
    }
    public function getUser()
    {

    }
}