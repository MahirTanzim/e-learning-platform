<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isTeacher();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'prerequisites' => 'nullable|string',
            'certificate_available' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Course title is required.',
            'description.required' => 'Course description is required.',
            'thumbnail.image' => 'Thumbnail must be an image file.',
            'thumbnail.max' => 'Thumbnail size must not exceed 2MB.',
            'price.required' => 'Course price is required.',
            'price.numeric' => 'Course price must be a number.',
            'category_id.required' => 'Course category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'level.required' => 'Course level is required.',
            'level.in' => 'Course level must be beginner, intermediate, or advanced.',
        ];
    }
}