<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/22
 * Time: 13:21
 */
namespace App\Models;


class Setting extends BaseModel
{
    protected $table = 'red_setting';

    public $timestamps = false;

    protected $fillable = [
        'banner',
        'kefu_image',
    ];



}