<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Requests\CourseRegistrationRequest;


class CourseRegistrationController extends Controller
{
    public function registerCourses(CourseRegistrationRequest $request)
{
    $user = auth()->user();
    $courseIds = $request->input('course_ids', []);

    $user->courses()->sync($courseIds);

    return response()->json(['message' => 'Course(s) registered successfully'], 200);
}
    
}
