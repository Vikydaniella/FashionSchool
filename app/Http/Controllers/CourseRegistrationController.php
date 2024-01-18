<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;


class CourseRegistrationController extends Controller
{
    public function registerCourses(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array|exists:courses,id',
        ]);

        $user = auth()->user();
        $user->courses()->sync($request->input('course_ids'));

        return response()->json(['message' => 'Course(s) registered successfully'], 200);
    }
}
