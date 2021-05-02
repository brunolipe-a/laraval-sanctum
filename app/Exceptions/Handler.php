<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
    'current_password',
    'password',
    'password_confirmation',
  ];
  public function render($request, Throwable $e)
  {
    if ($e instanceof AppException) {
      if ($request->expectsJson()) {
        return response()->json(
          [$e->getStatus() => $e->getMessage()],
          $e->getStatusCode(),
        );
      }

      return back()->with([$e->getStatus() => $e->getMessage()]);
    }

    if ($e instanceof ModelNotFoundException) {
      if ($request->expectsJson()) {
        return response()->json(
          ['message' => __('messages.model_not_found')],
          404,
        );
      }

      return back()->with(['error' => __('messages.model_not_found')]);
    }

    return parent::render($request, $e);
  }

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {
    $this->reportable(function (Throwable $e) {
      //
    });
  }
}
