<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comments
 *
 * @property int $id
 * @property int $user_id id author
 * @property int $news_id id news
 * @property int|null $parent_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereUserId($value)
 * @mixin \Eloquent
 */
class Comments extends Model
{
    protected $fillable = ['body', 'news_id', 'parent_id'];


    public function deleteCommentsByNews(int $newsId){
       return  self::where('news_id', $newsId)->delete();
    }
}
