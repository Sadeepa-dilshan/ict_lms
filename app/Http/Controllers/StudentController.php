<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\PastPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function indexNotes()
    {
        $notes = Note::all();
        return view('students.notes.index', compact('notes'));
    }

    public function indexPastPapers()
    {
        $pastPapers = PastPaper::all();
        return view('students.pastpapers.index', compact('pastPapers'));
    }

    public function showNote(Note $note)
    {
        return view('students.notes.show', compact('note'));
    }

    public function showPastPaper(PastPaper $pastPaper)
    {
        return view('students.pastpapers.show', compact('pastPaper'));
    }
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }
    public function destroy(User $student)
    {
        if (Auth::user()->role === 'admin') {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        }

        return redirect()->route('students.index')->with('error', 'Unauthorized action.');
    }
}
