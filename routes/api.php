<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UserController;

Route::prefix('project')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::prefix('courses')->group(function () {
            Route::post('create', [CoursesController::class, 'create']);
            Route::get('list', [CoursesController::class, 'index']);
            Route::get('export', [CoursesController::class, 'export']);
        });

        Route::post('enrol/courses', [UserController::class, 'registerCourses']);
    });
});