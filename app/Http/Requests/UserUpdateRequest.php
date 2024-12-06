<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required|min:3|max:40',
            'phone_number' => 'sometimes|min:8|max:20|unique:users,phone_number',
            'email' => 'sometimes|required|email|unique:users,email',
            'avatar' => 'sometimes|required|image',
            'password' => 'sometimes|min:8|confirmed',
        ];
    }
}
