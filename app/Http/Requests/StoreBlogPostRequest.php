<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isTeacher();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Blog post title is required.',
            'content.required' => 'Blog post content is required.',
            'featured_image.image' => 'Featured image must be an image file.',
            'featured_image.max' => 'Featured image size must not exceed 2MB.',
            'status.required' => 'Blog post status is required.',
            'status.in' => 'Blog post status must be draft or published.',
        ];
    }
}