<?php

namespace Illuminates\Sessions;

class Session
{    
    /**
     * make
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return mixed
     */
    public static function make(string $key, mixed $value) : mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }
    
    /**
     * has
     *
     * @param  mixed $key
     * @return mixed
     */
    public static function has(string $key) : mixed
    {
        return isset($_SESSION[$key]);
    }

        
    /**
     * flash
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return mixed
     */
    public static function flash(string $key, mixed $value = null) : mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
        static::forget($key);
        return $session;
    }

        
    /**
     * forget
     *
     * @param  mixed $key
     * @return void
     */
    public static function forget(string $key)
    {
        if(isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
        }
    }

        
    /**
     * forget_all
     *
     * @return void
     */
    public static function forget_all()
    {
        session_destroy();
    }
}