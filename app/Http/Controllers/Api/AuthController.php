<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

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


}