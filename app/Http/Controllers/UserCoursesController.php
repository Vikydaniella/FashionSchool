<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Requests\UserCoursesRequest;
use App\Http\Resources\UserCourseResource;
use App\Helpers\HttpStatus;

class UserCoursesController extends Controller
{
    /**
    * Register courses for the authenticated user.
    * @param \App\Http\Requests\UserRequest $request
    * @return a Json response
    */
    public function registerCourses(UserCoursesRequest $request)
{
    $user = auth()->user();
    $courseIds = $request->input('course_ids', []);

    $user->courses()->sync($courseIds);

    return response()->json(['message' => 'Course(s) registered successfully'], HttpStatus::SUCCESS_CREATED);

}
    /**
     * List courses for the authenticated user.
     * @param \Illuminate\Http\Request $request
     * @return  a Json response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $courses = Course::with(['users' => function ($query) use ($user) {
            $query->where('users.id', $user->id);
        }])->get();

        return response()->json([
            'message' => 'Courses listed successfully',
            'courses' => UserCourseResource::collection($courses)
        ], 200);
    }
}
