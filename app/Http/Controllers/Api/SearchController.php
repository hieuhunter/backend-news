<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Resources\Api\Post\PostCollection;
use App\Http\Controllers\Controller;
use App\Models\Post;

class SearchController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%' . $request->q . '%')
            ->orWhere('slug', 'LIKE', '%' . $request->q . '%')
            ->orWhere('excerpt', 'LIKE', '%' . $request->q . '%')
            ->orWhereHas('category', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('slug', 'LIKE', '%' . $request->q . '%');
            });

        $postsCount = $posts->get()->count();
        $posts = $posts->pagination();

        return $this->respondSuccessWithPagination(new PostCollection($posts), $postsCount);
    }
}
