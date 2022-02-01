<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $postService;
    private $categoryService;

    public function __construct(PostServiceInterface $postService, CategoryServiceInterface $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategory();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->postService->createPosts($request);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->author_id === Auth::id()) {
            return $this->accessEditRoute($post);
        }
        return redirect()->route('posts.index');
    }

    public function update(Request $request, Post $post)
    {
        $this->postService->updatePosts($request, $post);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePosts($post);
        return back();
    }

    private function accessEditRoute($post)
    {
        $allCatg = $this->categoryService->getAllCategory();
        $selectedCatg = $post->categories->pluck('id')->toArray();
        return view('posts.edit', compact('post', 'allCatg', 'selectedCatg'));
    }
}