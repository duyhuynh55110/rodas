<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
     * @param  \Throwable  $e
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
     * @param $request
     * @param  Throwable  $e
     * @return \Illuminate\Http\JsonResponse
     */
    private function customApiResponse($request, Throwable $e)
    {
        $e = $this->prepareApiException($request, $e);

        if (method_exists($e, 'getStatusCode')) {
            $httpCode = $e->getStatusCode();
        } else {
            $httpCode = HTTP_CODE_INTERNAL_SERVER_ERROR;
        }

        $response = [];

        switch ($httpCode) {
            case HTTP_CODE_UNAUTHORIZED:
                $response['message'] = 'Unauthorized';
                break;
            case HTTP_CODE_UNPROCESSABLE_ENTITY:
                // Only return first error message
                $errors = $e->original['errors'];
                $firstErrorKey = array_keys($errors)[0];
                $firstErrorMessage = array_values($errors[$firstErrorKey])[0];

                // status code
                $response['status'] = STATUS_CODE_INVALID_REQUEST;
                $response['message'] = $firstErrorMessage;
                break;
            default:
                $response['message'] = $httpCode == HTTP_CODE_INTERNAL_SERVER_ERROR ? 'Whoops, looks like something went wrong' : $e->getMessage();
        }

        return response()->json($response, $httpCode);
    }

    /**
     * Custom handle api exception
     *
     * @param $request
     * @param  Throwable  $e
     * @return Throwable $e
     */
    private function prepareApiException($request, Throwable $e)
    {
        $e = $this->prepareException($e);

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            $e = $this->convertValidationExceptionToResponse($e, $request);
        } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
            $e = $this->unauthenticated($request, $e);
        }

        return $e;
    }
}
