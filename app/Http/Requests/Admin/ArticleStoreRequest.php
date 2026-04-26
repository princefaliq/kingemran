<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleStoreRequest extends FormRequest
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
            'category_id' => ['nullable', 'exists:categories,id'],

            'title' => ['required', 'string', 'max:255'],

            'excerpt' => ['nullable', 'string'],

            'content' => ['required', 'string'],

            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'status' => ['required', Rule::in(['draft', 'published'])],

            'published_at' => ['nullable', 'date'],

            'is_featured' => ['nullable', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'content.required' => 'Konten wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
        ];
    }
}
