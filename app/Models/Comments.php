<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['body', 'news_id', 'parent_id'];


    public function deleteCommentsByNews(int $newsId){
       return  self::where('news_id', $newsId)->delete();
    }
}
