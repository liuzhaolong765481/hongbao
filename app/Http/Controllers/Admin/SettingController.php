<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;

class SettingController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     * @throws \App\Exceptions\RequestException
     */
    public function index()
    {
        $rules = [
            'id'            => 'nullable',
            'banner'        => 'nullable',
            'kefu_image'    => 'nullable',
        ];

        $this->validateInput($rules);

        if($this->request->isMethod('post')) {

            return $this->successOrFailed(
                Setting::whereKey($this->validated['id'])->update($this->validated)
            );
        }

        $setting = Setting::find(1);

        return $this->rView('setting.index',compact('setting'));
    }

}