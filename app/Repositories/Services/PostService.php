<?php
namespace App\Repositories\Services;

use App\Contracts\Services\PostServiceInterface;
use App\Repositories\Dao\PostDao;

class PostService implements PostServiceInterface
{
    private $postDao;
    public function __construct(PostDao $postDao)
    {
        $this->postDao = $postDao;
    }

    public function getPosts()
    {
        return $this->postDao->getPosts();
    }

    public function createPosts($request)
    {
        $reqList = [
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
            'author_id' => 'required|integer',
        ];
        $validate = $this->postDao->validateRequest($request, $reqList);
        return $this->postDao->createPosts($request, $validate);

    }

    public function updatePosts($request, $post)
    {
        $reqList = [
            'title' => 'required|string',
            'content' => 'required|string',
            'public_post' => 'required|boolean',
        ];
        $validate = $this->postDao->validateRequest($request, $reqList);
        return $this->postDao->updatePosts($request, $validate, $post);
    }

    public function deletePosts($post)
    {
        return $this->postDao->deletePosts($post);
    }

}