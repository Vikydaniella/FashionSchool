<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoursesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Course::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Category',
            'Course_code',
            'created_at',
            'updated_at'
        ];
    }
}






    

