<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\VideoLesson;
use Illuminate\Http\Request;

class VideoLessonController extends Controller
{
    public function index()
    {
        $courses = Course::with('videoLessons')->get();
        return view('video_lessons.index', compact('courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('video_lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_link' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        VideoLesson::create($request->all());

        return redirect()->route('video-lessons.index')->with('success', 'Video lesson created successfully.');
    }
}
