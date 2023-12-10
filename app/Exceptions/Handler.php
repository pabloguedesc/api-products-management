<?php

namespace App\Exceptions;

use App\Exceptions\CustomException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
    // Tratamento para CustomException
    if ($exception instanceof CustomException) {
      return response()->json(['error' => $exception->getMessage()], $exception->getCode());
    }

    // Trata erros 500 para retornar uma resposta JSON personalizada
    if ($request->wantsJson()) {
      if (
        $exception instanceof \ErrorException ||
        ($exception instanceof HttpException &&
          $exception->getStatusCode() === 500)
      ) {
        return response()->json([
          'message' => 'Erro interno, consulte o administrador'
        ], 500);
      }
    }

    return parent::render($request, $exception);
  }
}
