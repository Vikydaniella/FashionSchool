<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UserCoursesController;

Route::prefix('project')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::prefix('courses')->group(function () {
            Route::get('export', [CoursesController::class, 'export']);
            Route::get('list', [UserCoursesController::class, 'index']);
            Route::post('create', [CoursesController::class, 'create']);
        });

        Route::post('enrol/courses', [UserCoursesController::class, 'registerCourses']);
        
    });
});