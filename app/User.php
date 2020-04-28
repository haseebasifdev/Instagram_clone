<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'profile', "bio", 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getProfileAttribute($value)
    {
        if ($value) {
            return (asset('profiles/' . $value));
        } else {
            return (asset('images/download.jfif'));
        }
        // return (asset($value ? 'images/' . $value  : 'images/download.jfif'));
    }
    public function unreadNotifications()
    {
        return Notify::where('to', auth()->user()->id)->where('read', false)->get();
    }
}
