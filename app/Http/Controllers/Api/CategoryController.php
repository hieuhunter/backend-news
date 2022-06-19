<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Category\CategoryCollection;
use App\Models\Category;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
	use ApiResponser;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = new Category();
		$categoriesCount = $categories->get()->count();
		$categories = $categories->paginate();
		return $this->respondSuccessWithPagination(new CategoryCollection($categories), $categoriesCount);
	}
}
