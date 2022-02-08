<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;

class AdminController extends Controller
{
    private $postService;
    private $userService;
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPostsForAdmin(20);
        return view('admin.index', compact('posts'));
    }
    public function showUser()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.user', compact('users'));
    }
}