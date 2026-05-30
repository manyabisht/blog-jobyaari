<?php

namespace App\Http\Requests\Admin;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $slugSource = $this->filled('slug') ? $this->input('slug') : $this->input('title');

        $this->merge([
            'slug' => Str::slug((string) $slugSource),
        ]);
    }

    public function rules(): array
    {
        /** @var Blog|null $blog */
        $blog = $this->route('blog');

        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'required',
                'string',
                'max:220',
                Rule::unique('blogs', 'slug')->ignore($blog?->id),
            ],
            'category_id' => ['required', 'exists:categories,id'],
            'short_description' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string', 'min:80'],
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'published_at' => ['required', 'date'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ];
    }
}
