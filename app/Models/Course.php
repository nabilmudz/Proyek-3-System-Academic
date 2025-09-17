<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'credits',
        'semester',
        'major'
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id')
                    ->withPivot('enroll_date')
                    ->withTimestamps();
    }
}
