<?php

namespace App\Services;



use App\Models\User;
use EasyWeChat\Factory;

class AuthService extends BaseServices
{

    /**
     * @param $validate
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public static function login($validate)
    {

        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        $data = $app->auth->session($validate['code']);

        if(!User::where('openid', $data['openid'])->exists()){
            User::create(['openid' => $data['openid']]);
        }

        return $data;

    }


}