<?php

namespace App\Http\Requests\Admin;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\CustomFormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
{
	use CustomFormRequest;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:posts,slug,' . $this->id,
			'excerpt' => 'nullable|string|max:666',
			'content' => 'required|string|max:60000',
			'image' => 'nullable|string|max:255',
			'status' => 'required|string|in:publish,pending,draft,trash',
			'category_id' => 'required|integer',
			'tags' => 'required|array|min:1|max:66',
			'tags.*.name' => 'required|string|max:66',
		];
	}

	protected function prepareForValidation()
	{
		$slug = Str::slug($this->slug ?? $this->title, '-');
		$this->merge([
			'slug' => Post::where('slug', $slug)->where('id', '!=', $this->id)->exists() ? $slug . '-' . Str::lower(Str::random(6)) : $slug,
		]);
	}
}
