<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PastPaperController;
use App\Http\Controllers\VideoLessonController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::resource('/admin/notes', NoteController::class);
    Route::resource('/admin/past-papers', PastPaperController::class);
    Route::get('/admin/past-papers/{pastPaper}/edit', [PastPaperController::class, 'edit'])->name('admin.past-papers.edit');
    Route::put('/admin/past-papers/{pastPaper}', [PastPaperController::class, 'update'])->name('admin.past-papers.update');
    Route::resource('/admin/students', StudentController::class);
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/past-papers/create', [PastPaperController::class, 'create'])->name('past-papers.create');
    Route::post('/past-papers', [PastPaperController::class, 'store'])->name('past-papers.store');
    Route::get('/past-papers', [PastPaperController::class, 'index'])->name('past-papers.index');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('/courses/store', [CourseController::class, 'courseStore'])->name('courses.course_store');
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
    Route::get('/pastpapers/{pastPaper}', [PastPaperController::class, 'show'])->name('pastpapers.show');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/past-papers', [StudentController::class, 'indexPastPapers']);
    Route::get('/past-papers/{pastPaper}', [StudentController::class, 'showPastPaper']);
    Route::get('/video-lessons', [VideoLessonController::class, 'index'])->name('video-lessons.index');
    Route::get('/video-lessons/create', [VideoLessonController::class, 'create'])->name('video-lessons.create');
    Route::post('/video-lessons', [VideoLessonController::class, 'store'])->name('video-lessons.store');

});

// Route::middleware('auth')->group(function () {


// });

require __DIR__.'/auth.php';
