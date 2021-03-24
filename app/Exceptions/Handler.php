<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|mixed|\Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function render($request, Exception $exception)
    {
        // 测试环境正常输出错误信息
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        if ($request->isMethod('get')) {
            return $this->get($exception);
        }


        if ($request->isMethod('post')) {
            return $this->post($exception);
        }

        return 'BAD ERROR';
    }

    /**
     * get 异常跳转
     * @param Exception $exception
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function get(Exception $exception)
    {
        // 400 请求参数错误
        if ($exception instanceof RequestException) {
            return redirect('/');
        }

        // 302 跳转
        if ($exception instanceof RedirectException) {
            return response()->view('template.jump', [
                'msg' => $exception->getMessage(),
                'url' => '/',
                'ok'  => false
            ]);
        }

        // 404 页面跳转
        if ($exception instanceof NotFoundHttpException) {
            return redirect(route('404'));
        }

        // 登录 跳转
        if ($exception instanceof AuthenticationException) {
            redirect(route('admin.login'));
        }
        return redirect(route('500'));
    }

    /**
     * post异常跳转
     * @param Exception $exception
     * @return mixed
     */
    public function post(Exception $exception)
    {
        $outPut = new Controller();
        // 请求参数错误
        if ($exception instanceof RequestException) {
            return $outPut->badRequestError($exception->getMessage());
        }

        // 模型数据 查询错误
        if ($exception instanceof ModelNotFoundException) {
            return $outPut->noDataError();
        }

        // 后台身份认证失败
        if ($exception instanceof AuthenticationException) {
            return $outPut->invalidTokenError();
        }

        // 前台身份认证失败
        if ($exception instanceof AuthException) {
            return $outPut->invalidTokenError();
        }

        // 404 页面跳转
        if ($exception instanceof NotFoundHttpException) {
            return $outPut->notFoundError();
        }

        return $outPut->internalServerError();
    }


}
