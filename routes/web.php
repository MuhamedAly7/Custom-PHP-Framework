<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use Illuminates\FrameworkSettings;
use Illuminates\Router\Route;
use Illuminates\Sessions\Session;

// Route::get('/', HomeController::class, 'index');
// Route::get('/', fn() => 'Welcome to index!!');

Route::get('/', function (){
    // FrameworkSettings::setLocale('en');
    return Session::get('locale');
    return view('index');
});


Route::group(['prefix' => 'site'], function(){
    Route::get('/about', HomeController::class, 'about');
    // Route::get('/article/{id}', HomeController::class, 'article');
    Route::get('/article/{id}/{name}', function ($id, $name)
    {
        return $id."=".$name;
    });
});