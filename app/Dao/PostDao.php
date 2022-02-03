<?php
namespace app\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{
    public function getPosts($authorId = null)
    {
        $posts = Post::where('public_post', 1)->orderBy('created_at', 'desc');
        if ($authorId) {
            $posts = $posts->orWhere('author_id', $authorId);
        }
        return $posts = $posts->paginate(12);
    }

    public function createPost($data, $category_list = null)
    {
        $post = Post::create($data);
        return $post->categories()->attach($category_list);
    }

    public function updatePost($data, $category_list = null, $post)
    {
        $post->update($data);
        return $post->categories()->sync($category_list);
    }

    public function deletePost($post)
    {
        return $post->delete();
    }

    public function getAllPostsForAdmin($paginateLimit)
    {
        return Post::orderBy('updated_at', 'desc')->paginate($paginateLimit);
    }

}