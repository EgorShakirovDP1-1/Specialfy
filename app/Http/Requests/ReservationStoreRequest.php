<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
        Validator::extend('film_available', function ($attribute, $value, $parameters, $validator) {
            $start_date = $validator->getData()['start_date'];
            $end_date = $validator->getData()['end_date'];
            $film_id = $validator->getData()['filmId'];
        
            $reservations = Reservation::where('film_id', $film_id)
                ->where(function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date])
                        ->orWhereBetween('end_date', [$start_date, $end_date]);
                })->count();
        
            return $reservations == 0;
        }, 'The film is already reserved in this time range.');
        
        return [
            'start_date' => 'required',
            'film_pickup_place' => 'required|min:3|max:60',
            'film_return_place' => 'required|min:3|max:60',
            'start_date' => ['required', 'date', 'after_or_equal:today', 'film_available'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date', 'film_available'],
            'end_price' => 'required|numeric',
            'watch' => 'required|numeric|min:0|max:20000',
        ];
    }
}
