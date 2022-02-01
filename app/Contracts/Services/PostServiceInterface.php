<?php
namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function getPosts();
    public function createPosts($request);
    public function updatePosts($request, $post);
    public function deletePosts($post);
}