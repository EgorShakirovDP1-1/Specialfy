<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "post_id",
        "value",                                                             
    ];
    public function post()
{
    return $this->hasMany(Post::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
