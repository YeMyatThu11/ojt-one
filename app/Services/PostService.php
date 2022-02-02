<?php
namespace App\Services;

use App\Contracts\Services\PostServiceInterface;
use App\Dao\PostDao;

class PostService implements PostServiceInterface
{
    private $postDao;
    public function __construct(PostDao $postDao)
    {
        $this->postDao = $postDao;
    }

    public function getPosts($authorId = null)
    {
        return $this->postDao->getPosts($authorId);
    }

    public function createPost($data, $category_list = null)
    {
        return $this->postDao->createPost($data, $category_list);
    }

    public function updatePost($data, $category_list = null, $post)
    {
        return $this->postDao->updatePost($data, $category_list, $post);
    }

    public function deletePost($post)
    {
        return $this->postDao->deletePost($post);
    }

    public function getAllPostsForAdmin($paginateLimit)
    {
        return $this->postDao->getAllPostsForAdmin($paginateLimit);
    }

}