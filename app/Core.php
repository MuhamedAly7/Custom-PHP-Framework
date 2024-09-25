<?php

namespace App;

use App\Http\Middleware\SimpleMiddleware;

class Core
{
    public static $globalWeb = [
        \Illuminates\Sessions\Session::class
    ];

    public static $middlewareWebRoute = [
        'simple' => SimpleMiddleware::class
    ];

    public static $middlewareApiRoute =[
        
    ];
    
    public static $globalApi = [
        
    ];
}
