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
        if (Auth::check() && Auth()->user()->role == 1) {
            $posts = $this->postService->getAllPostsForAdmin(12);
        } else if (Auth::check() && Auth()->user()->role == 2) {
            $posts = $this->postService->getPosts(Auth::id());
        } else {
            $posts = $this->postService->getPosts();
        }
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
            'author_id' => 'required|string',
        ]);
        $category_list = $request->input('category_list');
        $this->postService->createPost($data, $category_list);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->author_id === Auth::id() || Auth()->user()->role == 1) {
            return $this->accessEditRoute($post);
        }
        return redirect()->route('posts.index');
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
        ]);
        $category_list = $request->input('category_list');
        $this->postService->updatePost($data, $category_list, $post);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if ($post->author_id === Auth::id() || Auth()->user()->role == 1) {
            $this->postService->deletePost($post);
            return back();
        }
        return redirect()->route('posts.index');
    }

    private function accessEditRoute($post)
    {
        $allCatg = $this->categoryService->getAllCategories();
        $selectedCatg = $post->categories->pluck('id')->toArray();
        return view('posts.edit', compact('post', 'allCatg', 'selectedCatg'));
    }
}