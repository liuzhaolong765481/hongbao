<?php

namespace App\Services;



use App\Models\User;
use EasyWeChat\Factory;

class AuthService extends BaseServices
{

    /**
     * @param $members
     * @return array
     */
    public static function login($validate)
    {

        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        $data = $app->auth->session($validate['code']);
        $openid = $data['openid'];
        User::create(['openid'=>$openid]);

        return $data;

    }


}