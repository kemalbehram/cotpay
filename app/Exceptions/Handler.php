<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            $errors = $exception->getMessage();

            if ($exception instanceof AuthenticationException) {
                return $this->responseErrors($errors, 401);
            }
            if ($exception instanceof UnauthorizedHttpException) {
                return $this->responseErrors($errors, 403);
            }
            if ($exception instanceof ModelNotFoundException) {
                return $this->responseErrors($errors, 404);
            }
            if ($exception instanceof NotFoundHttpException) {
                return $this->responseErrors($errors, 404);
            }
            if ($exception instanceof ValidationException) {
                $errors = $exception->errors();
                return $this->responseErrors($errors, 422);
            }
            return $this->responseErrors($errors, 500);
        }
        return parent::render($request, $exception);
    }

    /**
     * Parse errors to json_format
     *
     * @param  any $errors
     * @param  int $statusCode
     * @return JsonResponse
     */
    public function responseErrors($errors, int $statusCode): JsonResponse
    {
        if (!is_array($errors) && !is_object($errors)) {
            $errors = empty($errors) ? [] : [$errors];
        }
        $dataFomat = [
            'version' => Controller::API_VERSION,
            'api'     => request()->path(),
            'errors'  => empty($errors) ? (object) [] : $errors,
        ];
        Log::error('API: ' . request()->path() . PHP_EOL . var_export($dataFomat, true));
        return response()->json($dataFomat, $statusCode);
    }
}
