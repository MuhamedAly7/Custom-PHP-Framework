<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Illuminates\FrameworkSettings;
use Illuminates\Router\Route;
use Illuminates\Sessions\Session;

Route::group(['prefix' => '/api/', 'middleware' => [SimpleMiddleware::class]], function(){

    Route::get('/', function(){
        
        return FrameworkSettings::getLocale();
    });

    Route::get('any', HomeController::class, 'api_any', [UsersMiddleware::class]);

    Route::get('/users', function(){
        return "Welcome to users api route";
    }, [UsersMiddleware::class]);

    Route::get('/article', function(){
        return "Welcome to articles api route";
    });
});