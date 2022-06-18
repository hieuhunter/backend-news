<?php

namespace App\Models;

use App\Traits\CustomScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory, CustomScope;

	protected $fillable = [
		'title',
		'slug',
		'excerpt',
		'content',
		'image',
		'status',
		'category_id',
		'user_id',
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'post_tags');
	}

	public function getImageUrlAttribute()
	{
		return $this->image ? config('app.img_url') . '/' . $this->image : config('app.img_url') . '/' . 'default-image.png';
	}


}
