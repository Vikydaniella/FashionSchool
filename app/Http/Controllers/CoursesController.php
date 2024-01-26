<?php

namespace App\Http\Controllers;
use App\Jobs\CreateCoursesJob;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CoursesRequest;
use App\Exports\CoursesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ExportRequest;
use App\Helpers\HttpStatus;

class CoursesController extends Controller
{
    /**
    * Create courses using a job.
    * @return \Illuminate\Http\JsonResponse
    */
    public function create()
    {
        dispatch(new CreateCoursesJob());
        
        return response()->json(['message' => 'Courses created successfully', HttpStatus::SUCCESS_CREATED]);

    }

    /**
    * Export courses to a specified format (xlsx or csv).
    * @param string $format
    * @return \Illuminate\Http\Response
    */
    
    public function export(ExportRequest $request)
     {
        $export = new CoursesExport;

        return Excel::download($export, 'courses.' . $request->format);
    //     return Excel::download(new CoursesExport, 'courses.' . $format);
     }

   
}