<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateFormRequest;
use App\Http\Requests\UserLoginFormRequest;
use App\Models\Comments;
use App\Models\News;
use App\Models\User;
use App\Models\UsersSubscribeNews;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param UserCreateFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserCreateFormRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'date' => $user,
        ]);
    }

    public function login(UserLoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => ['Unauthorised']
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        $user = Auth::user();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'user' => $user,
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        $user = Auth::user();

       $user->countNews = (new News)->where('user_id', Auth::id())->count();
       $user->countComments = (new Comments)->where('user_id', Auth::id())->count();
       $user->countSubscribes = (new UsersSubscribeNews)->where('subscribe_user_id', Auth::id())->count();

        return response()->json([
            'data' => $user,
        ]);
    }

    public function subscribe(int $id)
    {
        $subscribe = new UsersSubscribeNews();
        $subscribe->user_id = Auth::id();
        $subscribe->subscribe_user_id = $id;
        $subscribe->save();

        return $subscribe;
    }
}
