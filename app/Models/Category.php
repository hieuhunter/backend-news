<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;

	protected $fillable = [
		/* 	'parents_id', */
		'name',
		'slug',
	];

	public function posts()
	{
		return $this->hasMany(Post::class, 'category_id', 'id');
	}

	/* 	public function parent()
	{
		return $this->belongsTo(Category::class, 'parents_id', 'id');
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'parents_id', 'id');
	} */
}
