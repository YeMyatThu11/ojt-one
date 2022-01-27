<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data=$request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'public_post' => 'required|boolean',
        'author_id'=>'required|string',
       ]);
       $id=Post::create($data)->id;
       $category_list=$request->input('category_list');
       array_map(function(string $v) use($id){
        $post_category=new PostCategory;
        $post_category->post_id=$id;
        $post_category->category_id=(int)$v;
        $post_category->save();
       },$category_list);
       return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.index',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       $allCatg= Category::all();
       $selectedCatg = $post->categories->map(function ($catg) {
            return $catg->only(['id']);
        })->toArray();
        return view('posts.edit',compact('post','allCatg','selectedCatg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $request ->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $post->title =$request->input('title');
        $post->content=$request->input('content');
        $post->save();
        $id=$post->id;
        $category_list=$request->input('category_list');
        $pc=PostCategory::where('post_id',$id)->delete();
        array_map(function(string $v) use($id){
         $post_category=new PostCategory;
         $post_category->post_id=$id;
         $post_category->category_id=(int)$v;
         $post_category->save();
        },$category_list);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
