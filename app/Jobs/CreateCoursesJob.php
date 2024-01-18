<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;


class CreateCoursesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * @return void
     */

    public function handle()
    {
        // DB::transaction(function () {
        //     factory(Courses::class, 50)->create();
        // });

        //Courses::factory()->count(50)->create();

        //app(Factory::class)->of(Courses::class)->count(50)->create();

        //app(Factory::class)->of(Courses::class)->count(50)->create();

        // $factory = app(Factory::class)->of(Courses::class);
        // $factory->count(50)->create();

        try {
            Courses::factory()->count(50)->create();
        } catch (\Exception $e) {
            \Log::error('Error in CreateCoursesJob: ' . $e->getMessage());
            throw $e;
        }

        
    
    }
}
