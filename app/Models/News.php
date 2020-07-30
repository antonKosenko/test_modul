<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'body'];

    public function comments()
    {
        return $this->hasMany(Comments::class, 'news_id', 'id');
    }


}
