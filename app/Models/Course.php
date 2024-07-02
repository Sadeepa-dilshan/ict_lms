<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'teacher_id','image_path'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function pastPapers()
    {
        return $this->hasMany(PastPaper::class);
    }
    public function videoLessons()
    {
        return $this->hasMany(VideoLesson::class);
    }
}
