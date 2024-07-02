<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PastPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastPaperController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        return view('past_papers.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10000',
            'course_id' => 'required|exists:courses,id',
        ]);

        $pastPaper = new PastPaper();
        $pastPaper->title = $request->title;
        $pastPaper->user_id = Auth::id();
        $pastPaper->course_id = $request->course_id;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('past_papers', 'public');
            $pastPaper->file_path = $filePath;
        }

        $pastPaper->save();

        return redirect()->route('past-papers.index')->with('success', 'Past paper uploaded successfully.');
    }

    public function index()
    {
        $courses = Course::with('pastPapers')->get();
        return view('past_papers.index', compact('courses'));
    }
    public function show(PastPaper $pastPaper)
    {
        return view('past_papers.show', compact('pastPaper'));
    }

    public function edit(PastPaper $pastPaper)
    {
        $courses = Course::all();
        return view('past_papers.edit', compact('pastPaper', 'courses'));
    }

    public function update(Request $request, PastPaper $pastPaper)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:10000',
            'course_id' => 'required|exists:courses,id',
        ]);

        $pastPaper->title = $request->title;
        $pastPaper->course_id = $request->course_id;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('past_papers', 'public');
            $pastPaper->file_path = $filePath;
        }

        $pastPaper->save();

        return redirect()->route('past-papers.index')->with('success', 'Past paper updated successfully.');
    }

    public function destroy(PastPaper $pastPaper)
    {
        $pastPaper->delete();
        return redirect()->route('past-papers.index')->with('success', 'Past paper deleted successfully.');
    }
}
