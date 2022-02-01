<?php
namespace App\Contracts\Dao;

interface CategoryDaoInterface
{
    public function getAllCategory();
    public function createCategories($validate);
    public function updateCategories($validate, $category);
    public function deleteCategories($category);
}
