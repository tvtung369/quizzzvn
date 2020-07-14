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
        
        // Student resource
        Route::get('students', 'Teacher\StudentController@index');
        Route::get('students/create', 'Teacher\StudentController@create');
        Route::post('students/store', 'Teacher\StudentController@store');
        Route::get('students/{id}/edit', 'Teacher\StudentController@edit');
        Route::post('students/{id}/update', 'Teacher\StudentController@update');
        Route::post('students/{id}/delete', 'Teacher\StudentController@delete');

        // Class resource
        Route::get('classes', 'Teacher\ClassController@index');
        Route::get('classes/create', 'Teacher\ClassController@create');
        Route::post('classes/store', 'Teacher\ClassController@store');
        Route::get('classes/{id}/edit', 'Teacher\ClassController@edit');
        Route::post('classes/{id}/update', 'Teacher\ClassController@update');
        Route::post('classes/{id}/delete', 'Teacher\ClassController@delete');
        
        // Subject resource
        Route::get('subjects', 'Teacher\SubjectController@index');
        Route::get('subjects/create', 'Teacher\SubjectController@create');
        Route::post('subjects/store', 'Teacher\SubjectController@store');
        Route::get('subjects/{id}/edit', 'Teacher\SubjectController@edit');
        Route::post('subjects/{id}/update', 'Teacher\SubjectController@update');
        Route::post('subjects/{id}/delete', 'Teacher\SubjectController@delete');
        
        // Question resource
        Route::get('questions', 'Teacher\QuestionController@index');
        Route::get('questions/create', 'Teacher\QuestionController@create');
        Route::post('questions/store', 'Teacher\QuestionController@store');
        Route::get('questions/{id}/edit', 'Teacher\QuestionController@edit');
        Route::post('questions/{id}/update', 'Teacher\QuestionController@update');
        Route::post('questions/{id}/delete', 'Teacher\QuestionController@delete');
        
        // Test resource
        Route::get('tests', 'Teacher\TestController@index');
        Route::get('tests/create', 'Teacher\TestController@create');
        Route::post('tests/store', 'Teacher\TestController@store');
        Route::get('tests/{id}/edit', 'Teacher\TestController@edit');
        Route::post('tests/{id}/update', 'Teacher\TestController@update');
        Route::post('tests/{id}/delete', 'Teacher\TestController@delete');
        // AJAX
        Route::post('tests/get-unit-list-of-subject', 'Teacher\TestController@getUnitListOfSubject');
        Route::post('tests/get-level-list-of-unit', 'Teacher\TestController@getLevelListOfUnit');
        Route::get('tests/get-question-list-of-test', 'Teacher\TestController@getQuestionListOfTest');
        Route::post('tests/get-question-list-of-test-by-criteria', 'Teacher\TestController@getQuestionListOfTestByCriteria');
        Route::post('tests/delete-question-of-test', 'Teacher\TestController@deleteQuestionOfTest');
    });
});