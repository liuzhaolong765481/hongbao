<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\RequestException;
use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{

    /**
     * 管理员登录
     * @return mixed
     * @throws \App\Exceptions\RequestException
     */
    public function login()
    {
        if(auth('admin')->check()){
            return redirect(route('admin.home'));
        }

        if($this->request->isMethod('post')){
            $rules = [
                'name' => 'required|string',
                'password' => 'required',
                'captcha' => 'required|captcha',
            ];

            $this->validateInput($rules);

            $admin = Admin::where('name', $this->validated['name'])
                ->where('password', encrypt_psd($this->validated['password']))
                ->first();

            // 登录
            if ($admin instanceof Admin) {

                \Auth::guard('admin')->login($admin);

                return $this->success();
            }

            return $this->badRequestError(trans('message.auth.login_failed'));
        }

        return $this->rView('auth.login');

    }


    /**
     * 退出登录
     */
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect(url('admin/auth/login'));

    }


    /**
     * 用户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     * @throws \App\Exceptions\RequestException
     */
    public function userList()
    {
        if($this->request->ajax()) {

            $rules = [
                'page'       => 'required',
                'limit'      => 'required',
            ];

            $this->validateInput($rules);

            $validated = $this->validated;


            $list = User::where([])
                ->page($validated['page'], $validated['limit'])
                ->get();

            return $this->showJsonLayui($list);
        }

        return $this->rView('auth.user_list');
    }




    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     * @throws \App\Exceptions\RequestException
     */
    public function managerList()
    {

        if($this->request->ajax()) {


            $rules = [
                'page'       => 'required',
                'limit'      => 'required',
            ];

            $this->validateInput($rules);

            $validated = $this->validated;

            $list = Admin::where([])
                ->page($validated['page'], $validated['limit'])
                ->get();

            return $this->showJsonLayui($list);
        }

        return $this->rView('auth.manager_list');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|mixed
     * @throws RequestException
     */
    public function editPassword()
    {
        $rules = [
            'password'     => 'nullable',
            'new_password' => 'nullable',
        ];

        $this->validateInput($rules);

        if($this->request->isMethod('post')) {

            if(Admin::whereKey(auth('admin')->id())->value('password') != encrypt_psd($this->validated['password'])){
                throw new RequestException('原密码输入错误');
            }

            return $this->successOrFailed(
                Admin::whereKey(auth('admin')->id())->update(
                    ['password' => encrypt_psd($this->validated['new_password'])]
                )
            );

        }

        return $this->rView('auth.edit_password');
    }

}