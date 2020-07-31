<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersSubscribeNews
 *
 * @property int $user_id id user
 * @property int $subscribe_user_id id user subscribe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersSubscribeNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersSubscribeNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersSubscribeNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersSubscribeNews whereSubscribeUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersSubscribeNews whereUserId($value)
 * @mixin \Eloquent
 */
class UsersSubscribeNews extends Model
{
    public $incrementing = false;
    public $timestamps = false;
}
