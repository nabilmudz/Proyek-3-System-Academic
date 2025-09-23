<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function showAll()
    {
        $courses = Course::all();
        return response([
            'success'=>true,
            'message'=>'Berhasil mendapatkan course',
            'data'=>$courses,
        ]);
    }
    public function index()
    {
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:courses,code|max:10',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'major' => 'required|string|max:100',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.course')
            ->with('success', 'Course created successfully!');
    }

    public function findByCode($code)
    {
        $course = Course::where('code', $code)->firstOrFail();
        return response()->json($course);
    }

    public function update(Request $request, $code)
    {
        $course = Course::where('code', $code)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'semester' => 'required|string|max:50',
            'major' => 'required|string|max:100',
        ]);

        $course->update($request->except(['code', 'id']));

        return redirect()->route('admin.course')
            ->with('success', 'Course updated successfully!');
    }

    public function delete($code)
    {
        $course = Course::where('code', $code)->firstOrFail();
        $course->delete();

        return redirect()->route('admin.course')
            ->with('success', 'Course deleted successfully!');
    }
    
}