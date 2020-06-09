<?php

use Phplite\Router\Route;

Route::prefix('teacher', function() {
    // Guest admin routes
    Route::middleware('GuestTeacher', function() {
        // Login page
        Route::get('/', 'Teacher\AuthController@index');
        Route::post('/', 'Teacher\AuthController@submit');
    });

    // Auth admin routes
    Route::middleware('AuthTeacher', function() {
        // Dashboard page
        Route::get('dashboard', 'Teacher\DashboardController@index');

        // Logout
        Route::post('logout', 'Teacher\AuthController@logout');
    });
});