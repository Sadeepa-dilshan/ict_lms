<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoLesson extends Model
{
    protected $fillable = ['title', 'youtube_link', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
