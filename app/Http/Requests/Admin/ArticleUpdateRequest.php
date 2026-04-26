<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],


            'category_id' => ['nullable', 'exists:categories,id'],

            'content' => ['required'],

            'thumbnail' => ['nullable', 'image'],

            'status' => ['required', 'in:draft,published'],

            'published_at' => ['nullable', 'date'],

            'is_featured' => ['nullable', 'boolean'],

            // 🔥 INI PENTING
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',

            'remove_thumbnail' => ['nullable', 'boolean'],
        ];
    }
}
