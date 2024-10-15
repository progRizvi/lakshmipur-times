<?php

namespace Modules\Blog\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->check() ? true : false;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:1000',
            'description' => 'required',
            'category_id' => 'array',
            'category_id.*' => 'required|exists:categories,id',
            'show_homepage' => 'nullable',
            'is_popular' => 'nullable',
            'status' => 'nullable',
            'latest' => 'nullable',
            'news_ticker' => 'nullable',
            'date' => 'required',
            'reporter' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'seo_title' => 'nullable|string|max:1000',
            'seo_description' => 'nullable|string|max:2000',
            'tags' => 'nullable|string|max:2000',
        ];

        // if ($this->isMethod('put')) {
        //     $rules['code'] = 'required|exists:languages,code';
        //     $rules['title'] = 'required|string|max:255';
        //     $rules['slug'] = 'sometimes|string|max:255|unique:news,slug,' . $this->blog;
        //     // $rules['image'] = 'nullable|image|max:2048';
        //     $rules['image'] = 'nullable';
        // }
        if ($this->isMethod('post')) {
            $rules['image'] = 'required';
            $rules['slug'] = 'required|string|max:255|unique:news,slug';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => __('Title is required'),
            'title.max' => __('Title maximum length of 255 characters'),
            'short_description.required' => __('Short description is required'),
            'short_description.max' => __('Short description maximum length of 1000 characters'),
            'description.required' => __('Description is required'),
            'category_id.required' => __('Category is required'),
            'category_id.*.required' => __('Category is required'),
            'date' => __('Date is required'),
            'reporter.required' => __('Reporter is required'),
            'state_id.required' => __('State is required'),
            'city_id.required' => __('City is required'),
            'image.required' => __('Image is required'),
            'slug.required' => __('Slug is required'),
        ];
    }
}
