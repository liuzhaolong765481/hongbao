<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/22
 * Time: 13:15
 */

namespace App\Models;


class Paper extends BaseModel
{
    protected $table = 'red_paper';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = null;

    const UN_GRANT = 1;  //未发放

    const GRANTED = 2; //已发放

    const SUCCESS = 3; //已领取

    protected $fillable = [
        'amount',
        'solt',
        'status',
        'uid',
        'pay_time',
        'create_time',

    ];


    protected $appends = [
        'status_string', 'nick_name'
    ];


    public function getStatusStringAttribute()
    {
        switch ($this->status){
            case self::UN_GRANT:
                return '未发放';
            case self::GRANTED:
                return '已发放';
            case self::SUCCESS:
                return '已领取';
            default:
                return '未知';
        }
    }

    public function getNickNameAttribute()
    {
        return $this->uid ? User::whereKey($this->uid)->value('nick_name') : '-';
    }

}