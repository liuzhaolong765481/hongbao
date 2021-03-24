<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/23
 * Time: 15:35
 */
namespace App\Services;



use App\Exceptions\RequestException;
use App\Models\Paper;
use EasyWeChat\Factory;

class PaymentServices extends BaseServices
{
    //单用户最多请求次数
    const MAX_REQUEST = 10;

    /**
     * 统一代付下单接口
     * @param $validated
     * @throws RequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function pay($validated)
    {
        //缓存请求
        if(CacheService::get(auth('web')->user()->openid) > self::MAX_REQUEST){
            throw new RequestException('当日请求已超10次');
        }
        CacheService::set(auth('web')->user()->openid);

        if($res = Paper::where('solt', $validated['solt'])->where('status', Paper::GRANTED)->first()){
            //处理代付逻辑
            self::handle($res);

        }

        throw new RequestException('口令输入错误 ~');

    }


    /**
     * @param Paper $res
     * @throws RequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function handle(Paper $res)
    {
        $app = Factory::payment(config("wechat.payment.default"));

        $param = [
            'partner_trade_no' => $res->solt,
            'openid'           => auth('web')->user()->openid,
            'check_name'       => 'NO_CHECK', // NO_CHECK：不校验真实姓名
//            're_user_name'     => "nickname", // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
            'amount'           => $res->amount * 100,
            'desc'             => "红包打款"
        ];

        \Log::channel('wechat')->info('申请微信代付：', $param);

        $result = $app->transfer->toBalance($param);

        \Log::channel('wechat')->info('代付同步返回：', $result);

        if ($result['return_code'] == 'SUCCESS') {
            $res->update([
                'status'   => Paper::SUCCESS,
                'uid'      => USER_ID,
                'pay_time' => date('Y-m-d H:i:s')
            ]);

        }

        throw new RequestException('网络加载失败');
    }


}