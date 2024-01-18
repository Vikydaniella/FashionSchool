<?php

namespace App\Http\Controllers;
use App\Jobs\CreateCoursesJob;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

    public function createCourses()
    {
        dispatch(new CreateCoursesJob());
        
        return response()->json(['message' => 'Courses created successfully', 200]);

    }

    public function listCoursesWithEnrollment(Request $request)
    {
        $user = auth()->user();
    $courses = Courses::with(['users' => function ($query) use ($user) {
        $query->where('users.id', $user->id);
    }])->get();

    return response()->json([
        'message' => 'Courses listed successfully',
        'courses' => $courses,
    ], 200);
    }

}