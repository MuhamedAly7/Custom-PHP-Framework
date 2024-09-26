<?php

namespace Illuminates\Router;

use Illuminates\Logs\Log;
use Illuminates\Middleware\Middleware;

class Router
{
    protected static $routes = [];
    protected static $groupAttributes = [];

    
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
        // $route = ltrim($route, '/');
        // self::$routes[$method][$route] = compact('controller', 'action', 'middleware');

        $route = self::applyGroupPrefix($route);
        $middleware = array_merge(static::getGroupMiddleware(), $middleware);

        self::$routes[] = [
            'method'     => $method,
            'uri'        => ltrim((string)$route, '/'),
            'controller' => $controller,
            'action'     => $action,
            'middleware' => $middleware
        ];
    }


        
    /**
     * group
     *
     * @param  mixed $attributes
     * @param  mixed $callback
     * @return void
     */
    public static function group($attributes, $callback) : void
    {
        $previousGroupAttribute = static::$groupAttributes;
        static::$groupAttributes = array_merge(static::$groupAttributes, $attributes);
        call_user_func($callback, new self);
        static::$groupAttributes = $previousGroupAttribute;
    }


        
    /**
     * applyGroupPrefix
     *
     * @param  mixed $route
     * @return string
     */
    protected static function applyGroupPrefix($route) : string
    {
        if (isset(static::$groupAttributes['prefix'])) {
            $full_route = rtrim(static::$groupAttributes['prefix'], '/').'/'.ltrim($route, '/');
            return rtrim(ltrim($full_route, '/'), '/');
        }
        else {
            return $route;
        }
    }


        
    /**
     * getGroupMiddleware
     *
     * @return array
     */
    protected static function getGroupMiddleware() : array
    {
        return static::$groupAttributes['middleware'] ?? [];
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
        $uri = rtrim(ltrim($uri, ROOT_DIR), '/');
        // $uri = empty($uri) ? '/' : $uri;
        $method = strtoupper($method);

        foreach (static::$routes as $route) {
            if ($route['method'] == $method) {
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $route['uri']);
                $pattern = "#^$pattern$#";
                if (preg_match($pattern, $uri, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $controller = $route['controller'];
                    if (is_object($controller)) {
    
                        $route['middleware'] = $route['action'];
                        $middlewareStack = $route['middleware'];
                        
                        // Prepare Data and add anonymous function to $next variable
                        $next = function($request) use ($controller, $params)
                        {
                            return $controller(...$params);
                        };

                        

                        // Middleware handling during using anonymous function
                        $next = Middleware::handleMiddleware($middlewareStack, $next);
                        
                        echo $next($uri);
                    }
                    else {
                        $action = $route['action'];
                        $middlewareStack = $route['middleware'];
                        
                        // Prepare Data and add anonymous function to $next variable
                        $next = function($request) use ($controller, $action, $params)
                        {
                            return call_user_func_array([new $controller, $action], $params);
                        };
    
                        // Middleware handling during using controller with action
                        $next = Middleware::handleMiddleware($middlewareStack, $next);
    
                        echo  $next($uri);
                    }
                    return '';
            }
            }
        }

        throw new Log('This route '. $uri .' not found');
    }

    
    
}

