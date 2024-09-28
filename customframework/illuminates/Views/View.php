<?php

namespace Illuminates\Views;

class View
{
    protected static $cacheDire;
    
        
    /**
     * prepare cache and check if view caching is exists
     *
     * @return void
     */
    protected static function prepare_cache()
    {
        self::$cacheDire = config('view.cache_dir');
        if (!is_dir(self::$cacheDire)) {
            mkdir(self::$cacheDire, 0755, true);
        }
    }

        
    /**
     * make render tpl files
     *
     * @param  mixed $view
     * @param  mixed $data
     * @return mixed
     */
    public static function make($view, null|array $data)
    {
        if (config('view.cache')) {

            self::prepare_cache();
            $cache_file = static::getCacheFilePath($view);
            if (static::isCacheValid($cache_file)) {
                return include $cache_file;
            }
            else {
                $output = static::generateViewOutput($view, $data);
                file_put_contents(static::getCacheFilePath($view), $output);
                return $output;
            }
        }
        else {   
            $view = str_replace('.', '/', $view);
            $path = config('view.path');
            extract($data);
            return include $path.'/'.$view.'.tpl.php';
        }
    }

        
    /**
     * getCacheFilePath
     *
     * @param  mixed $view
     * @return string
     */
    protected static function getCacheFilePath($view) : string
    {
        return static::$cacheDire .'/'. 'views' . '_' . md5(config('view.path') . '_' . $view) . '.cache.php';
    }

        
    /**
     * isCacheValid
     *
     * @param  mixed $file
     * @return void
     */
    protected static function isCacheValid($file)
    {
        return file_exists($file);
    }


        
    /**
     * generateViewOutput
     *
     * @param  mixed $view
     * @param  mixed $data
     * @return mixed
     */
    protected static function generateViewOutput($view, $data)
    {
        $view = str_replace('.', '/', $view);
        $path = config('view.path');
        extract($data);

        ob_start();
        include $path.'/'.$view.'.tpl.php';
        return ob_get_clean();
    }
}
