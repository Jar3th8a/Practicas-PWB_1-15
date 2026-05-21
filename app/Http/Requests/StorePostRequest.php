<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $post = $this->route('post');
        $uniqueTitleRule = Rule::unique('posts', 'title');

        if ($post instanceof Post) {
            $uniqueTitleRule = $uniqueTitleRule->ignore($post->id);
        }

        return [
            'title' => ['required', 'string', 'min:5', 'max:200', $uniqueTitleRule],
            'content' => ['required', 'string', 'min:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['required', 'array', 'min:1', 'max:5'],
            'tags.*' => ['exists:tags,id'],
            'published_at' => ['nullable', 'date', 'after:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos 5 caracteres.',
            'content.min' => 'El contenido debe tener al menos 50 caracteres.',
            'tags.required' => 'Debes seleccionar al menos 1 etiqueta.',
            'tags.min' => 'Debes seleccionar al menos 1 etiqueta.',
        ];
    }
}
