<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use Str;

class EnrollmentController extends Controller
{
    public function create(Request $request)
    {
        try {
            $student = Student::where('user_id', $request->me)->firstOrFail();

            $existing = Enrollment::where('student_id', $student->id)
                                  ->where('course_id', $request->course_id)
                                  ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already enrolled in this course.'
                ]);
            }

            // Create enrollment if not exists
            Enrollment::create([
                'id' => Str::uuid(),
                'student_id' => $student->id,
                'course_id' => $request->course_id,
                'enroll_date' => now()->toDateString()
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
