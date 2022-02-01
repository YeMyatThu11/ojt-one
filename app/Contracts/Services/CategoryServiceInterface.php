<?php
namespace App\Contracts\Services;

interface CategoryServiceInterface
{
    public function getAllCategory();
    public function createCategories($request);
    public function updateCategories($request, $category);
    public function deleteCategories($category);
}
