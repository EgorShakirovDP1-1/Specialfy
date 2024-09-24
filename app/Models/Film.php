<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'model',
        'year',
        'duration',
        'filmname',
        'genre',
        'volume',
        'description',
        'price_per_subscribtion',
        'price_per_watch',
        'filmImage1',
        'filmImage2',
        'filmImage3',
        'filmImage4',
        'filmImage5',
        'filmImage6',
        'filmImage7',
        'filmImage8'
    ];

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function likes_count() {
        return $this->hasMany(Like::class);
    }

    public function getImageURLs()
    {
        $maxImages = 8;
        $images = [];

        for ($i = 2; $i <= $maxImages; $i++) {
            $filmImage = 'filmImage' . $i;
            $image = $this->$filmImage;
            if ($image) {
                $images[] = url('storage/' . $image);
            }
        }

        return $images;
    }

    public function getFirstImageURL()
    {
        $filmImage = $this->filmImage1;
        if ($filmImage) {
            return url('storage/'.$filmImage);
        }

        return null;
    }
}
