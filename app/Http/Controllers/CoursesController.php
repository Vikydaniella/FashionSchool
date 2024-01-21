<?php

namespace App\Http\Controllers;
use App\Jobs\CreateCoursesJob;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CoursesRequest;
use App\Exports\CoursesExport;
use Maatwebsite\Excel\Facades\Excel;

class CoursesController extends Controller
{

    public function create()
    {
        dispatch(new CreateCoursesJob());
        
        return response()->json(['message' => 'Courses created successfully', 200]);

    }
    
    public function index(Request $request)
    {
        $user = auth()->user();
        $courses = Course::with(['users' => function ($query) use ($user) {
            $query->where('users.id', $user->id);
        }])->get();

        return response()->json([
            'message' => 'Courses listed successfully',
            'courses' => $courses,
        ], 200);
    }

    public function export()
    {
        //return Excel::download(new CoursesExport, 'courses.xlsx');
        return Excel::download(new CoursesExport, 'courses.csv');
    }
}