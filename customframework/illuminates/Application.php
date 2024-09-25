<?php


namespace Illuminates;

use App\Core;
use Illuminates\Router\Route;
use Illuminates\Router\Segment;

class Application
{
    protected $router;
        
    /**
     * start
     *
     * @return void
     */
    public function start()
    {   
        $this->router = new Route();
        if (Segment::get(0) == 'api') {
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
        $this->router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
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


