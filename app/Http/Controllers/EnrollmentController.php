<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Enrollment;
    use App\Models\Student;
    use Str;

    class EnrollmentController extends Controller
    {
        public function create(Request $request){
            try {
                $student = Student::where('user_id', $request->me)->firstOrFail();
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
