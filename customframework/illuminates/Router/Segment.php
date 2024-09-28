<?php

namespace Illuminates\Router;

use Illuminates\Application;

class Segment
{
    public static function uri()
    {
        return str_replace(ROOT_DIR, '', $_SERVER['REQUEST_URI']);
    }

    /**
     * get
     *
     * @param  mixed $offset
     * @return string
     */
    public static function get(int $offset) : string
    {
        $uri = rtrim(static::uri(), '/');
        $segment = explode('/', $uri);
        return isset($segment[$offset]) ? $segment[$offset] : '';
    }


    public static function all()
    {
        return explode('/', static::uri());
    }
    
}