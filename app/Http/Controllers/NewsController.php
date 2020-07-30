<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\NewsCreateRequest;
use \Auth;

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

    public function show(News $news)
    {
        return $news = News::findOrFail($news);
    }



}
