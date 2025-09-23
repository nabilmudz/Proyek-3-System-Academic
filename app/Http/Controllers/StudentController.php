<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class StudentController extends Controller
{
    public function index()
    {
        $mahasiswas = Student::with('user')->get();
        return view('admin.mahasiswa', compact('mahasiswas'));
    }
    
    public function getMe(Request $request)
    {
        $user = auth()->user();

        $mhs = Student::with('user')
            ->where('user_id', $user->id)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan mahasiswa',
            'data' => $mhs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:students,nim',
            'class' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'date',
        ]);

        $email = $request->nim . '@polban.sch.id';
        $password = $request->nim;
        $user = User::create([
            'id' => Str::uuid(),
            'username' => $request->name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        Student::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name,
            'nim' => $request->nim,
            'class' => $request->class,
            'study_program' => $request->study_program,
            'major' => $request->major,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('admin.mahasiswa')
            ->with('success', 'Mahasiswa created successfully!');
    }
    public function findByNim($nim)
    {
        $student = Student::with('user')->where('nim', $nim)->firstOrFail();
        return response()->json($student);
    }

    public function update(Request $request, $nim)
    {
        $student = Student::where('nim', $nim)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
        ]);

        $student->update($request->except(['nim', 'id', 'user_id']));

        return redirect()->route('admin.mahasiswa')
            ->with('success', 'Mahasiswa updated successfully!');
    }

    public function delete($nim)
    {
        $student = Student::where('nim', $nim)->firstOrFail();
        
        $student->delete();
        if ($student->user) {
            $student->user->delete();
        }

        return redirect()->route('admin.mahasiswa')
            ->with('success', 'Mahasiswa deleted successfully!');
    }

}
