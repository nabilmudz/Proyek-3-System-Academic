<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use Str;

class EnrollmentController extends Controller
{
    public function getMyEnrollment(Request $request){
        try {
            $me = auth()->user();
            $mahasiswa = Student::where('user_id', $me->id)->firstOrFail();
            $enrollments = Enrollment::
                with('course')
                ->where('student_id', $mahasiswa->id)
                ->get();

            return response()->json([
                'success'=> true,
                'message'=> 'Berhasil mendapatkan enrollment',
                'data'=> $enrollments
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }
    public function create(Request $request)
    {
        try {
            $me = auth()->user();
            $student = Student::where('user_id', $me->id)->firstOrFail();

            foreach ($request->course_ids as $course_id) {
                $existing = Enrollment::where('student_id', $student->id)
                                    ->where('course_id', $course_id)
                                    ->first();

                if ($existing) {
                    return response()->json([
                        'success'=> false,
                        'message'=> 'Anda sudah memiliki course!',
                        'data'=> null
                    ], 403);
                }

                Enrollment::create([
                    'id' => Str::uuid(),
                    'student_id' => $student->id,
                    'course_id' => $course_id,
                    'enroll_date' => now()->toDateString()
                ]);
            }

            return response()->json([
                'success' => true,
                'message'=> 'Berhasil melakukan enroll course!',
                'data' => Enrollment::with('course')
                            ->where('student_id', $student->id)
                            ->get()
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
