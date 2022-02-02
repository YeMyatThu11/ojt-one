<?php
namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function getPosts($authorId);
    public function getAllPostsForAdmin($paginateLimit);
    public function createPost($data, $category_list);
    public function updatePost($data, $category_list, $post);
    public function deletePost($post);
}