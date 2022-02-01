<?php
namespace App\Contracts\Dao;

interface PostDaoInterface
{
    public function getPosts();
    public function createPosts($request, $validate);
    public function validateRequest($request, $reqList);
    public function updatePosts($request, $validate, $post);
    public function deletePosts($post);
}