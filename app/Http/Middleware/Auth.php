<?php

namespace App\Http\Middleware;


use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class Auth
 * 用户登录认证
 * @package App\Http\Middleware
 */
class Auth
{
    /**
     * token 效验
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws AuthException
     */
    public function handle(Request $request, \Closure $next)
    {
        // 获取用户token
        $uid = User::whereOpenid($request->input('token', -1))->value('id');

        if (filled($uid) ) {
            define('USER_ID', $uid);
            \Auth::guard('web')->login(User::find($uid));
            return $next($request);
        }

        throw new AuthException();
    }
}
