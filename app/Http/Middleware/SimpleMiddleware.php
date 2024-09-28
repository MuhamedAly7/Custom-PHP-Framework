<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;
use Illuminates\FrameworkSettings;

class SimpleMiddleware implements Contract
{    
    public function handle($request, $next, ...$role)
    {
        FrameworkSettings::setLocale($_GET['lang']);
        // if($role[0] == 'user')
        // {
        //     header('Location: '.url('about'));
        //     exit();
        // }

        return $next($request);
    }
}