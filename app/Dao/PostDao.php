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
        return $posts = $posts->paginate(config('constant.pagination.homePagination'));
    }
    public function getPostByid($id)
    {
        return Post::find($id);
    }
    public function createPost($data, $category_list = null)
    {
        $post = Post::create($data);
        $post->categories()->attach($category_list);
        return $post;
    }

    public function updatePost($data, $category_list = null, $post)
    {
        $post->update($data);
        $post->categories()->sync($category_list);
        return $post;
    }

    public function deletePost($post)
    {
        return $post->delete();
    }

    public function getAllPostsForAdmin()
    {
        return Post::orderBy('updated_at', 'desc')->paginate(config('constant.pagination.adminPagination'));
    }

    public function searchPosts($term, $authorId = null)
    {
        $posts = Post::where(function ($q) use ($term) {
            $q->orWhere('title', 'LIKE', '%' . $term . '%')
                ->orWhere('content', 'LIKE', '%' . $term . '%')
                ->orWhereHas('user', function ($q) use ($term) {
                    return $q->where('name', 'LIKE', '%' . $term . '%');
                })
                ->orWhereHas('categories', function ($q) use ($term) {
                    return $q->where('name', 'LIKE', '%' . $term . '%');
                });
        });
        if ($authorId) {
            $posts = $posts->where(function ($q) use ($term, $authorId) {
                $q->where([['title', 'LIKE', '%' . $term . '%'], ['author_id', '=', $authorId]])
                    ->orWhere([['content', 'LIKE', '%' . $term . '%'], ['author_id', '=', $authorId]])
                    ->orWhere('public_post', 1);
            });
        } else {
            $posts = $posts->where('public_post', 1);
        }

        return $posts->paginate(config('constant.pagination.homePagination'), ['*'], 'pageno');
    }

    public function searchPostsAdmin($term)
    {
        return Post::where('title', 'like', '%' . $term . '%')
            ->orWhere('content', 'LIKE', '%' . $term . '%')
            ->orWhereHas('user', function ($q) use ($term) {
                return $q->where('name', 'LIKE', '%' . $term . '%');
            })
            ->orWhereHas('categories', function ($q) use ($term) {
                return $q->where('name', 'LIKE', '%' . $term . '%');
            })
            ->paginate(config('constant.pagination.adminPagination'), ['*'], 'pageno');
    }
}