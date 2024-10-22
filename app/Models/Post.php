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
        'category_id',
        'price',
        'title',
        'text'
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }   

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
   
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Post has many pictures
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
   
    
}
