<?php

namespace Illuminates\Router;

class Router
{
    protected static $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'PATCH'  => [],
        'DELETE' => []
    ];

    private static $public;

        
        
    /**
     * public_path
     *
     * @param  mixed $bind
     * @return string
     */
    public static function public_path($bind = null) : string
    {
        static::$public = $bind ?? '/public/';
        return static::$public;
    }
    
    /**
     * add
     *
     * @param  mixed $method
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function add(string $method, string $route, $controller, $action = null, array $middleware = [])
    {
        $route = ltrim($route, '/');
        self::$routes[$method][$route] = compact('controller', 'action', 'middleware');
    }

        
    /**
     * routes
     *
     * @return static $routes
     */
    public function routes()
    {
        return static::$routes;
    }
    
    /**
     * dispatch
     *
     * @param  mixed $uri
     * @param  mixed $method
     * @return void
     */
    public static function dispatch($uri, $method)
    {
        $uri = ltrim($uri, static::public_path());
        foreach (static::$routes[$method] as $key => $val) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $key);
            $pattern = "#^$pattern$#";
            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $controller = $val['controller'];
                if (is_object($controller)) {
                    echo $controller(...$params);
                    return '';
                }
                else {
                    $action = $val['action'];
                    $middlewareStack = $val['middleware'];
                    
                    $next = function($request) use ($controller, $action, $params)
                    {
                        return call_user_func_array([new $controller, $action], $params);
                    };

                    foreach(array_reverse($middlewareStack) as $middleware)
                    {
                        $next = function($request) use($middleware, $next)
                        {
                            // var_dump($middleware);
                            // exit();
                            return (new $middleware)->handle($request, $next);
                        };
                    }

                    return $next($uri);
                }
            }
        }

        throw new \Exception('This route '. $uri .' not found');
    }
}

