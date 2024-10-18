<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'category',
        'price',
        'Title',
        'text'
    ];

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes_count() {
        return $this->hasMany(Like::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    /*

    public function getImageURLs()
    {
        $maxImages = 8;
        $images = [];

        for ($i = 2; $i <= $maxImages; $i++) {
            $postImage = 'postImage' . $i;
            $image = $this->$postImage;
            if ($image) {
                $images[] = url('storage/' . $image);
            }
        }

        return $images;
    }

    public function getFirstImageURL()
    {
        $postImage = $this->postImage1;
        if ($postImage) {
            return url('storage/'.$postImage);
        }

        return null;
    }
*/
    
}
