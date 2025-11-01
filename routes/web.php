<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 🔹 Student Registration
Route::get('/student/register', [StudentController::class, 'showRegisterForm'])->name('student.register.form');
Route::post('/student/register', [StudentController::class, 'register'])->name('student.register');

// 🔹 Login/Logout Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'showLogoutPage'])->name('logout.page');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// 🔹 Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/courses', [StudentController::class, 'availableCourses'])->name('student.courses');
    Route::post('/student/enroll/{course}', [StudentController::class, 'enroll'])->name('student.enroll');
    Route::get('/student/enrolled', [StudentController::class, 'enrolledCourses'])->name('student.enrolled');
});

// 🔹 Teacher Routes
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/courses', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/courses/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher/courses', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/courses/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/courses/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/courses/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::get('/teacher/courses/{id}/students', [TeacherController::class, 'showStudents'])->name('teacher.students');
});
