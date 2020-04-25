<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function getAvatarAttribute($value)
    {
        // if ($value) {
        return (asset('images/' . $value));
        // } 
        // else {
        //     return (asset('/images/download.png'));
        // }
        // dd(asset('storage/' . $value ? 'storage/' . $value  : '/images/download.png'));
    }
}
