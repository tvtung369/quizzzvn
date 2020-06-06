<?php

use Phplite\Router\Route;

Route::get('users/{id}/edit', function() {
    echo 'test';
});

Route::any('/home', function () {
    echo "Home";
});

Route::get('/home', 'HomeController@index');

Route::prefix('admin', function() {
    Route::middleware('Admin|Owner', function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('users', 'UsersController@index');
        Route::get('admin', 'AdminsController@index');
    });
    
    Route::prefix('owner', function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('users', 'UsersController@index');
        Route::get('admin', 'AdminsController@index');
    });
});

