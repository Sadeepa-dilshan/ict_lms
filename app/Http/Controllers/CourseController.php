<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\Course;
use App\Models\PastPaper;
use App\Models\VideoLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->teacher_id = $request->teacher_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_images', 'public');
            $course->image_path = $imagePath;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('teacher');
        $notes = Note::where('course_id', $course->id)->get();
        $pastPapers = PastPaper::where('course_id', $course->id)->get();
        $videoLessons = VideoLesson::where('course_id', $course->id)->get();

        return view('courses.show', compact('course', 'notes', 'pastPapers', 'videoLessons'));
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $course->name = $request->name;
        $course->description = $request->description;
        $course->teacher_id = $request->teacher_id;

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($course->image_path) {
                Storage::disk('public')->delete($course->image_path);
            }
            $imagePath = $request->file('image')->store('course_images', 'public');
            $course->image_path = $imagePath;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
