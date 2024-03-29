<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])
    ->middleware('right');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/panel', [Controller\Site::class, 'panel'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/search', [Controller\Site::class, 'search'])
    ->middleware('auth');