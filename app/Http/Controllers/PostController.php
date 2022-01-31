<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        if (Auth::id()) {
            $posts = Post::where('public_post', 1)->orWhere('author_id', Auth::id())->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $posts = Post::where('public_post', 1)->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
            'author_id' => 'required|integer',
        ]);
        $id = Post::create($data)->id;
        $category_list = $request->input('category_list');
        if ($category_list !== null) {
            array_map(function (string $v) use ($id) {
                $post_category = new PostCategory;
                $post_category->post_id = $id;
                $post_category->category_id = (int) $v;
                $post_category->save();
            }, $category_list);
        }
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.index', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->author_id === Auth::id()) {
            $allCatg = Category::all();
            $selectedCatg = $post->categories->pluck('id')->toArray();
            return view('posts.edit', compact('post', 'allCatg', 'selectedCatg'));
        } else {
            return redirect()->route('posts.index');
        }
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
        ]);
        $post->update($data);
        $id = $post->id;
        $category_list = $request->input('category_list');
        $pc = PostCategory::where('post_id', $id)->delete();
        if ($category_list !== null) {
            foreach ($category_list as $value) {
                $post_category = new PostCategory;
                $post_category->post_id = $id;
                $post_category->category_id = (int) $value;
                $post_category->save();
            }
        }
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}