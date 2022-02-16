<?php
namespace app\Dao;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Models\Category;

class CategoryDao implements CategoryDaoInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }
    public function getCategoryById($id)
    {
        return Category::find($id);
    }
    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function updateCategory($data, $category)
    {
        return $category->update($data);
    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }

}