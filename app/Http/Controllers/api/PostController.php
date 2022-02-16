<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('s')) {
            return $this->searchPosts($request->get('s'));
        }
        if (Auth::check()) {
            $posts = $this->postService->getPosts(Auth::id());
        } else {
            $posts = $this->postService->getPosts();
        }
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->json()->all();
        $rules = [
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
            'author_id' => 'required|string',
            'category_list' => 'array',
        ];
        $validator = Validator::make($req, $rules);
        $data = $request->except('category_list');
        $category_list = $request->category_list;
        if ($validator->passes()) {
            $result = $this->postService->createPost($data, $category_list);
            return response()->json(['messsage' => 'created successfully', 'data' => $result], 200);
        } else {
            return response()->json([
                'messages' => 'fail to create post',
                'errors' => $validator->errors(),
            ], 422);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $req = $request->json()->all();
        $rules = [
            'title' => 'string',
            'content' => 'string',
            'public_post' => 'boolean',
            'author_id' => 'string',
            'category_list' => 'required|array',
        ];
        $validator = Validator::make($req, $rules);
        $data = $request->except('category_list');
        $category_list = $request->category_list;
        if ($validator->passes()) {
            $result = $this->postService->updatePost($data, $category_list, $post);
            return response()->json(['messsage' => 'posts updated successfully', 'data' => $result], 200);
        } else {
            return response()->json([
                'messages' => 'fail to update post',
                'errors' => $validator->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return response()->json(['messages' => 'post deleted successfully'], 200);
    }
}