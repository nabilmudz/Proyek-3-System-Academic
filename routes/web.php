<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'web' middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin');
    }
})->middleware('auth');


Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');;
    Route::post('/register', [AuthController::class,'register'])->name('register.store');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {
    Route::get('/', function () {
        $me = auth()->user();
        $mahasiswa = Student::where('user_id', $me->id)->firstOrFail();
        return view('mahasiswa.dashboard', compact('me', 'mahasiswa'));
    })->name('mahasiswa.dashboard');
    Route::get('/courses', function () {
        $courses = Course::all();
        return view('mahasiswa.course', compact( 'courses'));
    })->name('mahasiswa.course');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix("admin")->group(function () {

        // Admin Dashboard
        Route::get("/", function () {
            $mahasiswaCount = Student::count();
            $courseCount = Course::count();
            return view('admin.dashboard', compact('mahasiswaCount', 'courseCount'));
        })->name("admin.dashboard");
        Route::get("/course", 
        [CourseController::class, 'index'])
        ->name("admin.course");

        // API
        Route::get('/mahasiswa', 
        [StudentController::class, 'index'])
        ->name('admin.mahasiswa');

        Route::post('/mahasiswa', 
        [StudentController::class, 'store'])
        ->name('admin.mahasiswa.store');

        Route::get('/mahasiswa/data/{nim}', 
        [StudentController::class, 'findByNim'])
        ->name('mahasiswa.data');
        
        Route::put('/mahasiswa/{nim}', 
        [StudentController::class, 'update'])
        ->name('admin.mahasiswa.update');
        
        Route::delete('/mahasiswa/{nim}', 
        [StudentController::class, 'delete'])
        ->name('admin.mahasiswa.destroy');

        // Course routes
        Route::get('/course/data/{code}', 
        [CourseController::class, 'findByCode'])
        ->name('course.data');
        
        Route::post('/course', 
        [CourseController::class, 'store'])
        ->name('admin.course.store');
        
        Route::put('/course/{code}', 
        [CourseController::class, 'update'])
        ->name('admin.course.update');
        
        Route::delete('/course/{code}', 
        [CourseController::class, 'delete'])
        ->name('admin.course.destroy');

    });
});

require __DIR__.'/auth.php';