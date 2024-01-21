<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function registerCourses(UserRequest $request)
{
    $user = auth()->user();
    $courseIds = $request->input('course_ids', []);

    $user->courses()->sync($courseIds);

    return response()->json(['message' => 'Course(s) registered successfully'], 200);

    return response()->json([
        'status' => 'success',
        'status code' => '200',
        'message' => 'Course(s) registered successfully',
        'data' => [
            'user_id' => $user->id,
            'enrolled_courses' => $user->courses()->pluck('course_code'),
        ],
    ], 200);
}
    
}
