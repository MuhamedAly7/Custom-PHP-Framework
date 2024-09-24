<?php

use App\Http\Controllers\HomeController;
use Illuminates\Router\Route;

Route::get('/', fn() => 'Welcome to index!!');
// Route::get('/', function (){echo "Welcome to index!";});
// Route::get('/', HomeController::class, 'index');
Route::get('/about', HomeController::class, 'about');
// Route::get('/article/{id}', HomeController::class, 'article');
Route::get('/article/{id}/{name}', function ($id, $name)
{
    return $id."=".$name;
});