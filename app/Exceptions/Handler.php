<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
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
        $this->renderable(function (Throwable $e) {

            // 1. Let Laravel handle validation exceptions properly with 422
            if ($e instanceof ValidationException) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'errors'  => $e->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY); // Integer 422
            }

            // 2. Extract status code safely for HTTP exceptions
            $code = method_exists($e, 'getStatusCode') 
                ? $e->getStatusCode() 
                : (int) $e->getCode();

            // 3. Ensure the code is a valid HTTP status range (100–599)
            if ($code < 100 || $code > 599) {
                $code = Response::HTTP_BAD_REQUEST; // Default 400
            }

            // 4. Return clean JSON response with guaranteed integer status
            return response()->json([
                'error' => $e->getMessage(),
            ], $code);
        });
    }
}