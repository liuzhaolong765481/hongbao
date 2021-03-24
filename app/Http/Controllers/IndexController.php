<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/23
 * Time: 17:44
 */

namespace App\Http\Controllers;

use App\Models\Setting;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', ['setting' => Setting::find(1)]);
    }
}