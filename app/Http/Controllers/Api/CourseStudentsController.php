<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class CourseStudentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Course $course)
    {
        $this->authorize('view', $course);

        $search = $request->get('search', '');

        $students = $course
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'kiosk_participant_id' => [
                'required',
                'exists:kiosk_participants,id',
            ],
            'matric_no' => ['required', 'max:255', 'string'],
            'year' => ['required', 'max:255'],
            'semester' => ['required', 'max:255'],
        ]);

        $student = $course->students()->create($validated);

        return new StudentResource($student);
    }
}
