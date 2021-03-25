<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{

    /**
     * 验证字段本地化
     * @return array
     */
    public static function getCustomAttributes()
    {
        return [
            'code'          => 'code',
        ];
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\RequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function loginOrRegister()
    {
        $rules = [
            'code' => 'required'
        ];

        $this->validateInput($rules);

        return $this->success(AuthService::login($this->validated));

    }


    /**
     * 完善用户信息
     * @return mixed
     * @throws \App\Exceptions\RequestException
     */
    public function editUserInfo()
    {
        $rules = [
            'avatarUrl' => 'nullable',
            'city'      => 'nullable',
            'gender'    => 'nullable',
            'nickName'  => 'nullable',
            'province'  => 'nullable'
        ];

        $this->validateInput($rules);

        $validate = $this->validated;

        return $this->successOrFailed([
            User::whereKey(USER_ID)->update([
                'nick_name' => $validate['nickName'],
                'avatar' => $validate['avatarUrl'],
                'city' => $validate['province'] .'-'.$validate['city'],
                'sex' => $validate['gender']
            ])
        ]);

    }

}