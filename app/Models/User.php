<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_admin',
        'phone_number',
        'email',
        'password',
        'avatar',
        'user_type',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_type' => 'boolean',
    ];

 


    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getImageURL()
    {
        if ($this->avatar) {
            return url('storage/'.$this->avatar);
        }

        return url('/images/default-profile.png');
    }
    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->comments()->delete();
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
   

