<?php


Route::group([], function($r){
    /**
     * @var $r Route
     */
    //首页

    $r->group([],function ($r){
        /**
         * @var $r Route
         */
        $r->get('/', 'IndexController@index')->name('index');

    });

    /**
     * 公共部分
     */
    $r->group(['prefix' => 'public'], function ($r){
        /**
         * @var $r Route
         */
        //单文件上传
        $r->post('upload','PublicController@upload');
        //多文件上传
        $r->post('uploads','PublicController@uploads');

    });


});



