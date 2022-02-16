<?php
namespace App\Contracts\Services;

interface CategoryServiceInterface
{
    public function getAllCategories();
    public function createCategory($data);
    public function updateCategory($data, $category);
    public function deleteCategory($category);
    public function getCategoryById($id);
}