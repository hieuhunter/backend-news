<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Client
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/search', [SearchController::class, 'search']);

// Auth
Route::post('/auth/signin', [AuthController::class, 'signIn']);
Route::post('/auth/signup', [AuthController::class, 'signUp']);

Route::group(['middleware' => ['auth:sanctum', 'actived']], function () {
	Route::get('/auth/me', [AuthController::class, 'me']);
	Route::post('/auth/signout', [AuthController::class, 'signOut']);

	Route::get('/profile', [ProfileController::class, 'show']);
	Route::put('/profile', [ProfileController::class, 'update']);

	Route::post('/images/upload', [ImageController::class, 'upload']);
});

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'actived']], function () {
	Route::get('/users', [UserController::class, 'index'])->middleware('role:owner');
	Route::get('/users/{id}', [UserController::class, 'show'])->middleware('role:owner');
	Route::post('/users', [UserController::class, 'store'])->middleware('role:owner');
	Route::put('/users/{id}', [UserController::class, 'update'])->middleware('role:owner');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('role:owner');

	Route::get('/settings', [SettingController::class, 'show'])->middleware('role:owner|admin|moderator');
	Route::put('/settings', [SettingController::class, 'update'])->middleware('role:owner|admin|moderator');

	Route::get('/posts', [AdminPostController::class, 'index'])->middleware('role:owner|admin|moderator');
	Route::get('/posts/{id}', [AdminPostController::class, 'show'])->middleware('role:owner|admin|moderator');
	Route::post('/posts', [AdminPostController::class, 'store'])->middleware('role:owner|admin|moderator');
	Route::put('/posts/{id}', [AdminPostController::class, 'update'])->middleware('role:owner|admin');
	Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->middleware('role:owner');

	Route::get('/categories', [AdminCategoryController::class, 'index'])->middleware('role:owner|admin|moderator');
	Route::get('/categories/{id}', [AdminCategoryController::class, 'show'])->middleware('role:owner|admin|moderator');
	Route::post('/categories', [AdminCategoryController::class, 'store'])->middleware('role:owner|admin|moderator');
	Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->middleware('role:owner|admin');
	Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->middleware('role:owner');
});
