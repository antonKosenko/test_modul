<?php

namespace App\Services;

use App\Http\Requests\AudienceUpdateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Comments;
use App\Models\News;
use App\Http\Requests\NewsCreateRequest;
use \Auth;
use DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class NewsServices
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewsList()
    {
        return News::with('comments')->paginate();
    }


    public function createNews($request)
    {
        $news = new News($request);
        $news->user_id = Auth::id();
        $news->save();

        return $news;
    }

    public function getNews($id)
    {
        return News::with('comments')->findOrFail($id);
    }


    public function destroy($news)
    {
        $this->checkIsOwner($news);

        DB::transaction(function () use ($news) {
            (new Comments)->deleteCommentsByNews($news->id);
            $news->delete();
        });

    }

    public function update($request, $news)
    {
        $this->checkIsOwner($news);

        $news->fill($request->validated());
        $news->save();

    }

    public function topComments()
    {
        return News::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->paginate();
    }

    private function checkIsOwner($news)
    {
        if ($news->user_id != Auth::id()) {
            abort(403);
        }
    }

}
