<?php
namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function getPosts($authorId = null);
    public function getAllPostsForAdmin($paginateLimit);
    public function createPost($data, $category_list = null);
    public function updatePost($data, $category_list = null, $post);
    public function deletePost($post);
}