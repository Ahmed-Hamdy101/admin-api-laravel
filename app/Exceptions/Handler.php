<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        // define error handler 
        $this->renderable(function (Throwable $e) {
 
        // message for error
            return response([
                'error' => $e->getMessage(),
            ], $e->getCode() ? $e->getCode() : 400
            );
        });
    }
}
