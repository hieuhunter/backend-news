<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\CustomFormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'parent_id' => 'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $slug = Str::slug($this->slug ?? $this->name, '-');
        $this->merge([
            'slug' => Category::where('slug', $slug)->exists() ? $slug . '-' . Str::lower(Str::random(6)) : $slug,
        ]);
    }
}
