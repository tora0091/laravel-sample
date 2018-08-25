<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * 共通エラー画面
     *
     * @param HttpException $e 例外
     * @return View
     */
    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();
        $view = "common";
        switch ($status) {
            case 403:   // forbidden
            case 405:   // Method Not Allowed
            case 404:   // file not found
            case 419:   // token error
            case 500:   // server error
            case 503:   // server error
                $view = $status;
        }

        $page = "errors." . $view;

        /**
         * 503 かつ メンテナンスモードの場合は特定のViewを表示する
         * [メンテナンスモード]
         * > php artisan down
         * [メンテナンスモード解除]
         * > php artisan up
         * [メンテナンスモード対象外IP]
         * ・メンテナンスモード後に下記ファイルの[allowed]に許可IPを記載する 
         *   storage\framework\down
         * ・ファイルが存在する場合がメンテナンスモードとなる
         */
        if ($status === 503 && $e instanceof MaintenanceModeException) {
            $page = "maintenance.maintenance";
        }
        return response()->view($page, ['exception' => $e], $status);
    }
}
