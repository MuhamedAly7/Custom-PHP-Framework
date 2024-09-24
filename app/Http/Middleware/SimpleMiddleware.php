<?php

namespace App\Http\Middleware;

use Contracts\MiddlewareContract;

class SimpleMiddleware implements MiddlewareContract
{    
    /**
     * handle
     *
     * @param  mixed $request
     * @param  mixed $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (2 == 2) {
            header('Location: '.url('/'));
            exit();
        }
        return $next($request);
    }
}