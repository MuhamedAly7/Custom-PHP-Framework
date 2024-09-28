<?php

namespace Illuminates;

use Illuminates\Sessions\Session;

class FrameworkSettings
{    
    /**
     * set default Time Zone in MVC
     *
     * @return void
     */
    public static function setTimeZone()
    {
        date_default_timezone_set(config('app.timezone'));
    }
    
    /**
     * get current Time Zone
     *
     * @return string
     */
    public static function getTimeZone()
    {
        return date_default_timezone_get();
    }

        
    /**
     * get current Locale language
     *
     * @return string
     */
    public static function getLocale()
    {
        return Session::has('locale') ? Session::get('locale') : config('app.locale');
    }

    
    /**
     * set Locale language
     *
     * @param  mixed $locale
     * @return string
     */
    public static function setLocale(string $locale) : string
    {
        Session::make('locale', $locale);
        return (string)Session::get('locale');
    }
}