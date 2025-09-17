<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id', 
        'name', 
        'nim', 
        'class', 
        'study_program', 
        'major', 
        'gender', 
        'birth_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function courses(){
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
                    ->withPivot('enroll_date')
                    ->withTimestamps();
    }
}
