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

        //判断code是否过期
        if (isset($data['errcode'])) {

        }

        dd($data);
        $openid = $data['openid'];
        User::UpdateOrCreate(['openid'=>$openid],[
            'openid' => $openid,

        ]);

    }


}