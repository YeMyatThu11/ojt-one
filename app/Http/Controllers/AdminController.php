<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $postService;
    private $userService;
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->get('s')) {
            return $this->searchPosts($request->get('s'));
        }
        $posts = $this->postService->getAllPostsForAdmin(20);
        return view('admin.posts', compact('posts'));
    }

    public function showUser(Request $request)
    {
        if ($request->get('s')) {
            return $this->searchUsers($request->get('s'));
        }
        $users = $this->userService->getAllUsers();
        return view('admin.user', compact('users'));
    }

    public function searchPosts($term)
    {
        $term = $term;
        $posts = $this->postService->searchPosts($term, '15');
        return view('admin.posts', compact('posts', 'term'));
    }

    public function searchUsers($term)
    {
        $term = $term;
        $users = $this->userService->searchUsers($term);
        return view('admin.user', compact('users', 'term'));
    }
}