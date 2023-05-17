<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\AttendanceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('pages.dashboard');
});

Route::resource('menu', MenuController::class);
Route::resource('major', MajorController::class);
Route::resource('rayon', RayonController::class);
Route::resource('teacher', TeacherController::class)->except('update');
Route::post('teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
Route::resource('student', StudentController::class)->except('update');
Route::post('student/{id}', [StudentController::class, 'update'])->name('student.update');

Route::get('attendance/get-data', [AttendanceController::class, 'getData'])->name('attendance.get-data');
Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('attendance/presence', [AttendanceController::class, 'presence'])->name('attendance.presence');