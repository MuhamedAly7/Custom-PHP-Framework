<?php

namespace Illuminates\Sessions;

class Session
{    
    public function __construct()
    {
        session_save_path(config('session.session_save_path'));
        ini_set('session.gc_probability', 1);
        session_start([
            'cookie_lifetime' => config('session.expiration_timeout')
        ]);
    }
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
     * get
     *
     * @param  mixed $key
     * @return void
     */
    public static function get(string $key)
    {
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : $key;
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