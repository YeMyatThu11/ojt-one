<?php
namespace app\Repositories\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostDao implements PostDaoInterface
{
    public function getPosts()
    {
        $posts = Post::where('public_post', 1)->orderBy('created_at', 'desc');
        if (Auth::check()) {
            $posts = $posts->orWhere('author_id', Auth::id());
        }
        return $posts = $posts->paginate(12);
    }

    public function createPosts($request, $validate)
    {
        $post = Post::create($validate);
        $category_list = $request->input('category_list');
        return $post->categories()->attach($category_list);
    }

    public function validateRequest($request, $reqList)
    {
        $validate = $request->validate($reqList);
        return $validate;
    }

    public function updatePosts($request, $validate, $post)
    {
        $post->update($validate);
        $id = $post->id;
        $category_list = $request->input('category_list');
        return $post->categories()->sync($category_list);
    }

    public function deletePosts($post)
    {
        return $post->delete();
    }

}