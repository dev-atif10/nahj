<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;  

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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            // Handle API requests only
            if ($request->is('api/*')) {

                // Validation errors
                if ($e instanceof ValidationException) {
                    return $this->error(
                        'بيانات غير صالحة',
                        422,
                        $e->errors()
                    );
                }

                // Model not found
                if ($e instanceof ModelNotFoundException) {
                    return $this->error(
                        'المورد غير موجود',
                        404
                    );
                }

                // Route not found
                if ($e instanceof NotFoundHttpException) {
                    return $this->error(
                        'المسار غير موجود',
                        404
                    );
                }

                // Method not allowed
                if ($e instanceof MethodNotAllowedHttpException) {
                    return $this->error(
                        'نوع الطلب غير مسموح',
                        405
                    );
                }

                // Default server error
                return $this->error(
                    'خطأ في الخادم الداخلي',
                    500
                );
            }
        });
    }
}
