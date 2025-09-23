<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
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
        return redirect()->route('admin.dashboard');
    }
})->middleware('auth');


Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');;

    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class,'register'])->name('auth.register');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {
    Route::get('/', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
    Route::get('/courses', function () {
        return view('mahasiswa.course');
    })->name('mahasiswa.course');
});

Route::prefix('enrollment')->group(function () {
    Route::get('/get-course', [EnrollmentController::class,'getMyEnrollment'])->name('enroll.get.course')->middleware(['auth', 'role:mahasiswa']);
    Route::post('/create', [EnrollmentController::class,'create'])->name('enroll.course');
});

Route::prefix('courses')
    ->group(function () {
        Route::get(
            '/show-all', [CourseController::class, 'showAll'])
            ->name('course.showAll')
            ->middleware(['auth', 'role:mahasiswa']);
        // Route::post('/create', [EnrollmentController::class, 'create'
    });

Route::prefix('student')
    ->group(function () {
        Route::get('/me', [StudentController::class, 'getMe'])->name('student.me')->middleware(['auth', 'role:mahasiswa']);
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