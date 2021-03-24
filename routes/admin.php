<?php

Route::any('/','AuthController@login')->name('admin.login');

Route::any('auth/login','AuthController@login')->name('admin.login');

Route::group(['middleware' => 'admin'], function ($r) {

    Route::group(['prefix' => 'auth'], function ($r){
        /**
         * @var $r Route
         */
        $r->get('logout','AuthController@logout');
        $r->get('user-list','AuthController@userList');
        $r->get('manager-list','AuthController@managerList');
        $r->any('edit-password', 'AuthController@editPassword');

    });

    Route::group(['prefix' => 'index'], function ($r){
        /**
         * @var $r Route
         */
        $r->get('home','IndexController@home')->name('admin.home');
        $r->any('console','IndexController@console');

    });



    Route::group(['prefix' => 'paper'], function ($r) {
        /**
         * @var $r Route
         */
        $r->any('paper-list', 'PaperController@paperList');
        $r->get('add-paper','PaperController@addPaper');
        $r->post('add-paper','PaperController@addPaperPost');
        $r->any('export','PaperController@exportPaper');
        $r->post('update','PaperController@update');


    });

    Route::group(['prefix' => 'setting'], function ($r){
        /**
         * @var $r Route
         */
        $r->any('index','SettingController@index');

    });


});