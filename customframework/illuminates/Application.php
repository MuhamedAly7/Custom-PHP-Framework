<?php


namespace Illuminates;

use App\Core;
use Illuminates\Router\Route;
use Illuminates\Router\Segment;

class Application
{
    protected $router;
    protected $framework_setting;
        
    /**
     * start
     *
     * @return void
     */
    public function start()
    {   
        $this->router = new Route();
        $this->framework_setting = new FrameworkSettings;
        $this->framework_setting::setTimeZone();

        if (parse_url(Segment::get(0))['path'] == 'api') {
            $this->apiRoute();
        }
        else {
            $this->webRoute();
        }
    }


    
    /**
     * __destruct
     *
     * @return void
     */
    public function __destruct()
    {
        $this->router->dispatch(parse_url($_SERVER['REQUEST_URI'])['path'], $_SERVER['REQUEST_METHOD']);
    }
    
    /**
     * runWebRoute
     *
     * @return void
     */
    public function webRoute()
    {
        foreach (Core::$globalWeb as $global) {
            new $global();
        }
        $this->framework_setting::setLocale(config('app.locale'));
        include route_path('web.php'); 
    }

        
    /**
     * runApiRoute
     *
     * @return void
     */
    public function apiRoute()
    {
        foreach (Core::$globalApi as $global) {
            new $global();
        }
        include route_path('api.php');
    }
}


