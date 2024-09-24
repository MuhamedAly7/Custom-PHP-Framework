<?php

namespace Illuminates\Router\Traits;


trait Methods
{
    /**
     * get
     *
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function get(string $route, $controller, $action = null, array $middleware = []) : void
    {
        static::add('GET', $route, $controller, $action, $middleware);
    }

        
    /**
     * post
     *
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function post(string $route, $controller, $action, array $middleware = []) : void
    {
        static::add('POST', $route, $controller, $action, $middleware);
    }

        
    /**
     * put
     *
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function put(string $route, $controller, $action, array $middleware = []) : void
    {
        static::add('PUT', $route, $controller, $action, $middleware);
    }


    
    /**
     * patch
     *
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function patch(string $route, $controller, $action, array $middleware = []) : void
    {
        static::add('PATCH', $route, $controller, $action, $middleware);
    }

    
    /**
     * delete
     *
     * @param  mixed $route
     * @param  mixed $controller
     * @param  mixed $action
     * @param  mixed $middleware
     * @return void
     */
    public static function delete(string $route, $controller, $action, array $middleware = []) : void
    {
        static::add('DELETE', $route, $controller, $action, $middleware);
    }
}
