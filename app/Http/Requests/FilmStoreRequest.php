<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
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
            'author' => 'required',
            'model' => 'required',
            'year' => 'required',
            'duration' => 'required',
            'filmname' => 'required',
            'genre' => 'required|min:3',
            'volume' => 'required',
            'description' => 'required',
            'ndc' => 'required',
            'price_per_watch' => 'required',
            'filmImage1' => 'required|image',
            'filmImage2' => 'required|image',
            'filmImage3' => 'required|image',
            'filmImage4' => 'nullable|image',
            'filmImage5' => 'nullable|image',
            'filmImage6' => 'nullable|image',
            'filmImage7' => 'nullable|image',
            'filmImage8' => 'nullable|image',
        ];
    }
}
