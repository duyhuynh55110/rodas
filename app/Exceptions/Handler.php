<?php

namespace App\Exceptions;

use App\Traits\HandleErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HandleErrorException;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        // If the request wants JSON (AJAX doesn't always want JSON)
        if ($request->expectsJson()) {
            return $this->customApiResponse($request, $e);
        }

        // Default to the parent class' implementation of handler
        return parent::render($request, $e);
    }

    /**
     * Return JSON format if request have content type is 'application/json'
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function customApiResponse($request, Throwable $e)
    {
        $e = $this->prepareException($e);

        switch (get_class($e)) {
            case ValidationException::class:
                return $this->renderValidateException($e, $request);
            case NotFoundHttpException::class:
                return $this->renderApiNotFoundResponse($e);
            case BadRequestHttpException::class:
                return $this->renderApiBadRequestResponse($e);
            case AuthenticateHttpException::class:
                return $this->renderUnauthenticatedException($e);
            case ModelNotFoundException::class:
                return $this->renderApiModelNotFoundResponse($e);
            case EmptyCartProductsHttpException::class:
                return $this->renderForbiddenException($e);
            default:
                return $this->renderServerErrorException($e);
        }
    }
}
