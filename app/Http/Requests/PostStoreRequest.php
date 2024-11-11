<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
        
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'title' => 'required|string|max:50',
        'text' => 'required|string|max:6000',
        'postImage1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation for images
        // Repeat validation rules for other postImage fields as needed
    ];
}}
