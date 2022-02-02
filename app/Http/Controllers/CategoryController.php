<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $redirect = $request->redirect;
        return view('categories.create', compact('redirect'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $this->categoryService->createCategory($data);
        return is_null($request->redirect) ? redirect()->route('categories.index') : redirect($request->redirect);
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $this->categoryService->updateCategory($data, $category);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return back();
    }
}