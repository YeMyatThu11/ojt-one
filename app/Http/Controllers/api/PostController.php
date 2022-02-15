<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $postService;
    private $categoryService;

    public function __construct(PostServiceInterface $postService, CategoryServiceInterface $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $rules = [
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
            'author_id' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return response()->json($data);
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
    public function show($id)
    {
        $user = $this->postService->getPostByid($id);
        return new PostResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}