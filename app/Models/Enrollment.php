<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = ['student_id', 'course_id', 'enrolled_at'];

    // 🔥 Disable automatic timestamps (fixes your error)
    public $timestamps = false;

    // Relationships
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
