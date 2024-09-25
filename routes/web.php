<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use Illuminates\Router\Route;
use Illuminates\Sessions\Session;

// Route::get('/', HomeController::class, 'index');
// Route::get('/', fn() => 'Welcome to index!!');
Route::get('/', function (){
    return 'another index page';
}, ['simple,admin']);
Route::get('/about', HomeController::class, 'about');
// Route::get('/article/{id}', HomeController::class, 'article');
Route::get('/article/{id}/{name}', function ($id, $name)
{
    return $id."=".$name;
});