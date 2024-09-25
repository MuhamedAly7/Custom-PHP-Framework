<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class SimpleMiddleware implements Contract
{    
    public function handle($request, $next, ...$role)
    {
        if($role[0] == 'user')
        {
            header('Location: '.url('about'));
            exit();
        }

        return $next($request);
    }
}