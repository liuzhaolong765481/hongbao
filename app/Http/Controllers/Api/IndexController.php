<?php

/**
 * Created by lzl
 * Date: 2021 2021/3/22
 * Time: 18:56
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\PaymentServices;

class IndexController extends Controller
{

    /**
     * 代付
     * @return mixed
     * @throws \App\Exceptions\RequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function sendSolt()
    {
        $rules = [
            'solt' => 'required|string'
        ];

        $this->validateInput($rules);

        return $this->success(PaymentServices::pay($this->validated));
    }

    /**
     * 获取服务端配置
     * @return mixed
     */
    public function getSetting()
    {
        return $this->success(Setting::find(1));
    }

}