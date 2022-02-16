<?php
namespace App\Contracts\Dao;

interface CategoryDaoInterface
{
    public function getAllCategories();
    public function createCategory($data);
    public function updateCategory($data, $category);
    public function deleteCategory($category);
    public function getCategoryById($id);
}