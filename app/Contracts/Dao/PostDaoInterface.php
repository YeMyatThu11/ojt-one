<?php
namespace App\Contracts\Dao;

interface PostDaoInterface
{
    public function getPosts($authorId = null);
    public function getAllPostsForAdmin($paginateLimit);
    public function createPost($data, $category_list = null);
    public function updatePost($data, $category_list = null, $post);
    public function deletePost($post);
    public function searchPosts($term, $paginateLimit = 12);
}