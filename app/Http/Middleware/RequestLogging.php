<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * RequestLogging
 */
class RequestLogging
{
    /**
     * Hide sensitive data when logging
     *
     * @var array
     */
    const SENSITIVE_FIELDS = ['email', 'password', '_token', 'authorization', 'api_key', 'secret', 'XSRF-TOKEN'];

    /**
     * Hide sensitive data by replacing values with asterisks
     *
     * @param array $data
     * @return array
     */
    private function hideSensitiveData($data)
    {
        foreach (self::SENSITIVE_FIELDS as $field) {
            if (isset($data[$field])) {
                $data[$field] = '[SENSITIVE]';
            }
        }

        return $data;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Logs for the Request
        $this->requestLogging($request);

        // Proceed with the Request
        $response = $next($request);

        // Logs for the Response
        $this->responseLogging($response);

        return $response;
    }

    /**
     * Log incoming request details with sensitive data filtered
     *
     * @return void
     */
    private function requestLogging(Request $request)
    {
        $context = [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'parameters' => $this->hideSensitiveData($request->all()),
        ];

        // Only log headers for production and local environment to save cost
        if (in_array(env('APP_ENV'), ['prod', 'local'])) {
            $header = collect($request->header())->only('referer', 'accept', 'user-agent', 'cache-control', 'host', 'content-type');
            $context['headers'] = $this->hideSensitiveData($header);
        }

        Log::info('[request]', $context);
    }

    /**
     * Log response details with JSON content validation
     *
     * @param  Response  $response
     * @return void
     */
    private function responseLogging($response)
    {
        json_decode($response->getContent(), true);
        $context = [
            'status' => $response->status(),
            'content' => json_last_error() == JSON_ERROR_NONE ? $response->getContent() : '',
        ];

        Log::info('[response]', $context);
    }
}
