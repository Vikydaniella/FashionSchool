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
        $enrollmentData = [];
        foreach ($request->input('course_ids') as $courseId) {
            
            $enrollmentData[$courseId] = ['enrollment_date' => now()];
        }
    
        $user->courses()->sync($enrollmentData);

        return response()->json(['message' => 'Course(s) registered successfully'], 200);
    }
}
