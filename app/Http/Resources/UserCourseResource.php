<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'course_id' => $this->id,
            'course_title' => $this->title,
            'course_category' => $this->category,
            'course_code' => $this->course_code,
            'student_name' => $this->users->isNotEmpty() ? $this->users->first()->name : null, 
            'enrolment_date' => $this->users->isNotEmpty() && $this->users->first()->pivot->created_at ? $this->users->first()->pivot->created_at->format('Y-m-d') : null,
            
        ];
    }
}
