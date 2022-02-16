<?php
namespace App\Services;

use App\Contracts\Services\CategoryServiceInterface;
use App\Dao\CategoryDao;

class CategoryService implements CategoryServiceInterface
{
    private $categoryDao;
    public function __construct(CategoryDao $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    public function getAllCategories()
    {
        return $this->categoryDao->getAllCategories();
    }

    public function getCategoryById($id)
    {
        return $this->categoryDao->getCategoryById($id);
    }

    public function createCategory($data)
    {
        return $this->categoryDao->createCategory($data);
    }

    public function updateCategory($data, $category)
    {
        return $this->categoryDao->updateCategory($data, $category);
    }

    public function deleteCategory($category)
    {
        return $this->categoryDao->deleteCategory($category);
    }
}