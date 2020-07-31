<?php
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
Use App\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api')->name('logout');
});

//Route::get('/news', 'NewsController@index');
//Route::get('/news/{news}', 'NewsController@show');
//Route::post('/news', 'NewsController@store');
//Route::resource('news', 'NewsController');

Route::group(['middleware' => ['auth:api'/*, 'verified'*/]], function () {
    Route::get('user', 'AuthController@user')->name('user');
    Route::post('user/subscribe/{id}', 'AuthController@subscribe')->name('user.subscribe');

    Route::resource('news', 'NewsController');
    Route::resource('comments', 'CommentsController');
   // Route::delete('news/{id}', 'NewsController@destroy');
});

