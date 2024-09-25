<?php

use App\Http\Middleware\SimpleMiddleware;
use Illuminates\Router\Route;

Route::group(['prefix' => '/api/', 'middleware' => [SimpleMiddleware::class]], function(){

    Route::get('/', function(){
    return 'Welcome to api route';
    });

    Route::get('/users', function(){
        return "Welcome to users api route";
    });

    Route::get('/article', function(){
        return "Welcome to articles api route";
    });
});