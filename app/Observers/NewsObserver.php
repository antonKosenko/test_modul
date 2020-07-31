<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewsCreate;
use Illuminate\Support\Facades\Notification;

class NewsObserver
{
    public function saved(News $news)
    {
        // @TODO send notis subscribes

        Log::warning($news->user_id);

    }
}
