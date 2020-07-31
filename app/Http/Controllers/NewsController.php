<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudienceUpdateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Comments;
use App\Models\News;
use App\Http\Requests\NewsCreateRequest;
use App\Models\User;
use \Auth;
use DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return News::with('comments')->paginate();
    }


    public function store(NewsCreateRequest $request)
    {
        $news = new News($request->validated());
        $news->user_id = Auth::id();
        $news->save();

        return $news;
    }

    public function show($id)
    {
        return $news = News::with('comments')->findOrFail($id);
    }


    public function destroy(News $news)
    {
        $this->checkIsOwner($news);

        DB::transaction(function () use ($news) {
            (new Comments)->deleteCommentsByNews($news->id);
            $news->delete();
        });

        return response()->json([
            'message' => 'News deleted.',
        ]);
    }

    public function update(NewsUpdateRequest $request, News $news)
    {
        $this->checkIsOwner($news);

        $news->fill($request->validated());
        $news->save();

        return response()->json([
            'message' => 'News updated.',
        ]);

    }

    public function topComments()
    {
        $tableNews = (new News)->getTable();
        $tableComment = (new Comments)->getTable();

        return News::select("$tableNews.*")
            ->selectRaw("count($tableComment.news_id) as count")
            ->leftjoin($tableComment, "$tableComment.news_id", "=", "$tableNews.id")
            ->orderBy('count', "DESC")
            ->groupBy("$tableNews.id")
            ->paginate();
    }

    private function checkIsOwner($news)
    {
        if ($news->user_id != Auth::id()) {
            abort(403);
        }
    }

}