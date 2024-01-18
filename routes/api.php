<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseRegistrationController;



Route::controller(AuthController::class)->prefix('project')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth');
    Route::post('refresh', 'refresh')->middleware('auth');

});

Route::post('/project/courses/create', [CoursesController::class, 'createCourses']);

Route::post('/project/enrol/courses', [CourseRegistrationController::class, 'registerCourses']);

Route::get('/project/courses/list', [CoursesController::class, 'listCoursesWithEnrollment']);

