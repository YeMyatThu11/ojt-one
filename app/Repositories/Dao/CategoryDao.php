<?php
namespace app\Repositories\Dao;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Models\Category;

class CategoryDao implements CategoryDaoInterface
{
    public function getAllCategory()
    {
        $categories = Category::all();
        return $categories;
    }

    public function createCategories($validate)
    {
        return Category::create($validate);
    }

    public function updateCategories($validate, $category)
    {
        return $category->update($validate);
    }

    public function deleteCategories($category)
    {
        return $category->delete();
    }

}
