<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Traits\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->id,
            'parent_id' => 'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $slug = Str::slug($this->slug ?? $this->name, '-');
        $this->merge([
            'slug' => Category::where('slug', $slug)->where('id', '!=', $this->id)->exists() ? $slug . '-' . Str::lower(Str::random(6)) : $slug,
        ]);
    }
}
