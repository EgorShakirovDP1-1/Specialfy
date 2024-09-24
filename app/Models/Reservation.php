<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
        'start_date',
        'film_pickup_place',
        'film_return_place',
        'start_date',
        'end_date',
        'end_price',
        'watch',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
