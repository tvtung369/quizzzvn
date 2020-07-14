<?php

use Phplite\Router\Route;

Route::prefix('/', function() {
    Route::get('/', 'Student\HomeController@index');
});