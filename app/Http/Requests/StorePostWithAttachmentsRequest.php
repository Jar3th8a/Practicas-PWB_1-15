<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostWithAttachmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:200', 'unique:posts,title'],
            'content' => ['required', 'string', 'min:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['required', 'array', 'min:1', 'max:5'],
            'tags.*' => ['exists:tags,id'],
            'published_at' => ['nullable', 'date', 'after:today'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
        ];
    }

    public function messages(): array
    {
        return [
            'attachments.max' => 'No puedes subir más de 5 archivos.',
            'attachments.*.max' => 'Cada archivo no debe superar 5MB.',
            'attachments.*.mimes' => 'Solo se aceptan JPG, PNG, PDF, DOC, DOCX.',
        ];
    }
}
