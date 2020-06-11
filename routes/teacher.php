<?php

use Phplite\Router\Route;

Route::prefix('teacher-panel', function() {
    // Guest admin routes
    Route::middleware('GuestTeacher', function() {
        // Login page
        Route::get('/login', 'Teacher\AuthController@index');
        Route::post('/login', 'Teacher\AuthController@submit');
    });

    // Auth admin routes
    Route::middleware('AuthTeacher', function() {
        // Logout
        Route::post('/logout', 'Teacher\AuthController@logout');

        // Dashboard page
        Route::get('/dashboard', 'Teacher\DashboardController@index');
        
        // Teachers resource
        Route::get('teachers', 'Teacher\TeacherController@index');
        Route::get('teachers/create', 'Teacher\TeacherController@create');
        Route::post('teachers/store', 'Teacher\TeacherController@store');
        Route::get('teachers/{id}/edit', 'Teacher\TeacherController@edit');
        Route::post('teachers/{id}/update', 'Teacher\TeacherController@update');
        Route::post('teachers/{id}/delete', 'Teacher\TeacherController@delete');
    });
});