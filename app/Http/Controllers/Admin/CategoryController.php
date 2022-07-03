<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Traits\ApiResponser;
use App\Models\Category;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponser;

    public function index(Request $request)
    {
        $categories = new Category();
        if ($request->filled('q')) {
            $categories = $categories->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('slug', 'LIKE', '%' . $request->q . '%');
        }
        $categoriesCount = $categories->get()->count();
        $categories = $categories->paginate();
        return $this->respondSuccessWithPagination(new CategoryCollection($categories), $categoriesCount);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $this->respondSuccess(new CategoryResource($category));
    }

    public function store(StoreCategoryRequest $request)
    {
        $categoryData = $request->all();
        $category = Category::create($categoryData);
        return $this->respondSuccess(new CategoryResource($category));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $categoryData = $request->all();
        $category = Category::findOrFail($id);
        $category->update($categoryData);
        return $this->respondSuccess(new CategoryResource($category));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->respondSuccess(new CategoryResource($category));
    }
}
