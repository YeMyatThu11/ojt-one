<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        if (Auth::check()) {
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
        return $this->accessEditRoute($post);

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

    public function search(Request $request)
    {
        $term = $request('searchTerm');
        dd($term);
        if (is_null($term)) {
            return $request->redirect ? redirect()->route('admin.dashboard') : redirect()->route('posts.index');
        }
        $posts = $this->postService->searchPosts($term);
        return is_null($request->redirect) ? view('posts.index', compact('posts', 'term')) : view($request->redirect, compact('posts', 'term'));
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return back();

    }

    private function accessEditRoute($post)
    {
        $allCatg = $this->categoryService->getAllCategories();
        $selectedCatg = $post->categories->pluck('id')->toArray();
        return view('posts.edit', compact('post', 'allCatg', 'selectedCatg'));
    }
}