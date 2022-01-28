<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(12);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
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
        $allCatg = Category::all();
        $selectedCatg = $post->categories->pluck('id')->toArray();
        return view('posts.edit', compact('post', 'allCatg', 'selectedCatg'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
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