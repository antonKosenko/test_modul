<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property int $id
 * @property int|null $user_id id author
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $comments
 * @property-read int|null $comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUserId($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $fillable = ['title', 'body'];

    public function comments()
    {
        return $this->hasMany(Comments::class, 'news_id', 'id');
    }


}
