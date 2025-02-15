<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $modelName = class_basename($exception->getModel());

            return response()->json([
                'message'=>"{$modelName} Not Found",
                'success'=>false,
            ], 404);
        }

        if ($exception instanceof HttpResponseException) {
            return response()->json([
                'message'=>$exception->getMessage(),
                'success'=>false,
            ], $exception->getCode());
        }
        return parent::render($request, $exception);
    }
}
