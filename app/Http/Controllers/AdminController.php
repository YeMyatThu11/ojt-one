<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;

class AdminController extends Controller
{
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPostsForAdmin(20);
        return view('admin.index', compact('posts'));
    }
}