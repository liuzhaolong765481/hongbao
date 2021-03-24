<?php

namespace App\Services;


class CacheService extends BaseServices
{

    const PREFIX = 'token_';

    const TTL = 60 * 60 * 24;  //默认存储时间为24小时


    /**
     * @param $param
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function set($param)
    {
        if (\Cache::get(self::PREFIX . $param)) {

           \Cache::increment(self::PREFIX . $param);
        }else{
            \Cache::set(self::PREFIX . $param,1, self::TTL);
        }
    }


    /**
     * 获取缓存
     * @param $param
     * @return mixed
     */
    public static function get($param)
    {

        if ($res = \Cache::get(self::PREFIX . $param)) {

            return $res;
        }

        return 0;
    }


    /**
     * 刷新指定键名缓存
     * @param $param
     */
    public static function refresh($param)
    {
        \Cache::forget(self::PREFIX . $param);
    }
}