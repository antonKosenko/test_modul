<?php

namespace App\Observers;

use App\Jobs\SendEmailSubscribers;
use App\Models\News;
use App\Models\User;
use App\Models\UsersSubscribeNews;
use \Auth;
use App\Notifications\NewsCreate;

class NewsObserver
{
    public function saved(News $news)
    {

        $subscribesIds =   (new UsersSubscribeNews)->where('subscribe_user_id', $news->user_id)->pluck('user_id')->toArray();
        $users = (new User)->whereIn('id', $subscribesIds)->get()->toArray();

        if($users){
            foreach ($users as $user){
                $arrayNotis = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'url' => route('news', $news->id)
                ];
                SendEmailSubscribers::dispatch($arrayNotis);
            }
        }

    }
}
