<?php

namespace App\Exceptions;

use Exception;
use http\Exception\BadMethodCallException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the errors types that are not reported.
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
     * Report or log an errors.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an errors into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $errors)
//    {
//        return parent::render($request, $errors);
//    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof HttpException && $exception->getCode()==403) {
            // put your redirect logic here
            return redirect()->route('login');
//            return view('errors.403')->with('message', $errors->getMessage());
        } else if ($exception instanceof \ErrorException) {
            return view('errors.404')->with('message', $exception->getMessage());
        } else if ($exception instanceof BadMethodCallException) {
            return view('errors.404')->with('message', $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
