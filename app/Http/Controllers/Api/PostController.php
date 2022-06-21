<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Post\PostCollection;
use App\Http\Resources\Api\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::where('status', 'publish');
        if ($request->has('tag')) {
            $posts = $posts->whereHas('tag', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }
        if ($request->has('category')) {
            $posts = $posts->whereHas('category', function ($q) use ($request) {
                $descendantCategory = Category::where('slug', $request->category)->first();
                $q->wherein('id', Category::descendantsAndSelf($descendantCategory->id)->pluck('id'));
            });
        }
        $postsCount = $posts->get()->count();
        $posts = $posts->pagination();
        return $this->respondSuccessWithPagination(new PostCollection($posts), $postsCount);
    }
    public function show($slug)
    {
        $post = Post::where('status', 'publish')->where('slug', $slug)->firstOrFail();
        return $this->respondSuccess(new PostResource($post));
    }
}
