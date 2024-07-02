<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $courses = Course::with('notes')->get();
        return view('notes.index', compact('courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('notes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->course_id = $request->course_id;
        $note->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notes_images', 'public');
            $note->image_path = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('notes_pdfs', 'public');
            $note->pdf_path = $pdfPath;
        }

        $note->save();

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }
    
    public function edit(Note $note)
    {
        $courses = Course::all();
        return view('notes.edit', compact('note', 'courses'));
    }
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $note->title = $request->title;
        $note->content = $request->content;
        $note->course_id = $request->course_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notes_images', 'public');
            $note->image_path = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('notes_pdfs', 'public');
            $note->pdf_path = $pdfPath;
        }

        $note->save();

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }
    public function destroy(Note $note)
    {
        if (Auth::user()->role === 'admin') {
            $note->delete();
            return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
        }

        return redirect()->route('notes.index')->with('error', 'Unauthorized action.');
    }
}
