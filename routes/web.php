<?php

use App\Http\Controllers\RoleRedirectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('/', function () {return view('welcome');});

Route::get('/redirect-by-role', RoleRedirectController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/course', [CourseController::class, 'index'])->name('course');

    // Role-gate areas
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [CourseController::class, 'dashboard']);
        Route::post('/course', [CourseController::class, 'store'])->name('new.course');
        Route::get('/course/{id}', [CourseController::class, 'show']);
        Route::get('/user',  [LectureController::class, 'index']);
        Route::post('/user', [RegisteredUserController::class, 'users'])->name('new.user');
        Route::post('/student', [StudentController::class, 'store'])->name('new.student');
        Route::get('/attendance', [AttendanceController::class, 'index']);
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance');
        Route::post('/attach', [LectureController::class, 'store'])->name('attach');
        Route::get('/academy', [AcademyController::class, 'index']);
        Route::post('/academy/module', [AcademyController::class, 'store'])->name('new.module');
        Route::post('/academy/marks', [MarksController::class, 'store'])->name('new.marks');
    });
    
    Route::middleware('role:admin|lecture')->group(function () {
        Route::get('/dash', [CourseController::class, 'dashboard'])->name('dashboard');
        
    });
    
    Route::middleware('role:lecture')->group(function () {
       
    });
});

require __DIR__.'/auth.php';