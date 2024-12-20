<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:40',
            'phone_number' => 'required|min:8|max:20|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required|boolean',
            'password' => 'required|min:8|confirmed',
        ];
    }
    
}
