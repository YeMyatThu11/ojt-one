<?php
namespace App\Repositories\Services;

use App\Contracts\Services\CategoryServiceInterface;
use App\Repositories\Dao\CategoryDao;
use App\Repositories\Dao\PostDao;

class CategoryService implements CategoryServiceInterface
{
    private $categoryDao;
    public function __construct(CategoryDao $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    public function getAllCategory()
    {
        return CategoryDao::getAllCategory();
    }

    public function createCategories($request)
    {
        $reqList = [
            'name' => 'required|string',
        ];
        $validate = PostDao::validateRequest($request, $reqList);
        return $this->categoryDao->createCategories($validate);
    }

    public function updateCategories($request, $category)
    {
        $reqList = [
            'name' => 'required|string',
        ];
        $validate = PostDao::validateRequest($request, $reqList);
        return $this->categoryDao->updateCategories($validate, $category);
    }

    public function deleteCategories($category)
    {
        return $this->categoryDao->deleteCategories($category);
    }
}