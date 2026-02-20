<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(9);

        return view('Courses.all', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->is_admin() > 0) {
            return view('admin.Courses.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('Courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function mycourse()
    {
        if (auth()->user()->has_any_course()) {
            $courses = auth()->user()->Courses()->where('user_id', auth()->id())->where('status', 'completed')->paginate(6);

            return view('Courses.all', compact('courses'));
        } else {
            abort(404, 'اشتري دورة واذا كنت تظن ان هناك خطأ اتصل بفريق الدهم');
        }
    }
}
