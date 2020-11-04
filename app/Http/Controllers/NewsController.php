<?php

namespace App\Http\Controllers;

use App\Services\NewsServices;
use Exception;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use App\Http\Requests\NewsCreateRequest;

class NewsController extends Controller
{

    private $newsService;

    public function __construct()
    {
        $this->newsService = new NewsServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->newsService->getNewsList();
    }

    /**
     * @param NewsCreateRequest $request
     * @return News
     */
    public function store(NewsCreateRequest $request)
    {
        return $this->newsService->createNews($request->validated());
    }

    public function show($id)
    {
        return $this->newsService->getNews($id);
    }


    public function destroy(News $news)
    {
        try {
            $this->newsService->destroy($news);
            return response()->json([
                'message' => 'News deleted.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(NewsUpdateRequest $request, News $news)
    {
        try {
            $this->newsService->update($request, $news);
            return response()->json([
                'message' => 'News updated.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function topComments()
    {
        return News::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->paginate();
    }



}
