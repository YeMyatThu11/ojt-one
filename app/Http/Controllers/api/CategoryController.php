<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\CategoryServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
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
            'name' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $category = $this->categoryService->createCategory($data);
            return response()->json(['messsage' => 'category created successfully', 'data' => $category], 200);
        } else {
            return response()->json([
                'messages' => 'fail to create category',
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
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->json()->all();
        $rules = [
            'name' => 'required|string',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $result = $this->categoryService->updateCategory($data, $category);
            return response()->json(['messsage' => 'category updated successfully', 'data' => $result], 200);
        } else {
            return response()->json([
                'messages' => 'fail to update category',
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
    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return response()->json(['messages' => 'categry deleted successfully'], 200);
    }
}