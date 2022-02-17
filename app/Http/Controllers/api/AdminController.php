<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
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

    public function showPosts(Request $request)
    {
        if ($request->get('s')) {
            return $this->searchPosts($request->get('s'));
        }
        $posts = $this->postService->getAllPostsForAdmin();
        return PostResource::collection($posts);
    }

    public function showUser(Request $request)
    {
        if ($request->get('s')) {
            return $this->searchUsers($request->get('s'));
        }
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function searchPosts($term)
    {
        $posts = $this->postService->searchPostsAdmin($term)->appends(['s' => $term]);
        return PostResource::collection($posts);
    }

    public function searchUsers($term)
    {
        $users = $this->userService->searchUsers($term)->appends(['s' => $term]);
        return UserResource::collection($users);
    }
}