<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\PublicResultController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MarksheetController;
use App\Http\Controllers\ExaminationController;

Route::get('/', function () {
    return view('public.home');
});

Route::get('/result', [PublicResultController::class, 'index'])->name('public.result');
Route::post('/result', [PublicResultController::class, 'show'])->name('public.result.show');

// Result PDF route
Route::get('/result/download', [PublicResultController::class, 'download'])
    ->name('public.result.download');


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('students', StudentController::class);
    Route::get('/students/class/{class}', [StudentController::class, 'classWise'])
    ->name('students.class');


    //  Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    // Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    // Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
     Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');




Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::get('/teachers/list', [TeacherController::class, 'list'])->name('teachers.list');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
// Update teacher
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');


Route::resource('fees', FeeController::class);
Route::get('/fees/class/{class}', [FeeController::class, 'classWise'])
    ->name('fees.class');

Route::post('/fees/class/{class}', [FeeController::class, 'storeClassWise'])
    ->name('fees.class.store');

// show edit status page
Route::get('/fees/{fee}/edit-status', [FeeController::class, 'editStatus'])
    ->name('fees.editStatus');

// update status
Route::put('/fees/{fee}/update-status', [FeeController::class, 'updateStatus'])
    ->name('fees.updateStatus');

    // routes/web.php
Route::get('/attendance', [AttendanceController::class, 'index']);
Route::post('/attendance/show', [AttendanceController::class, 'show']);
Route::post('/attendance/store', [AttendanceController::class, 'store']);

// Route::get('/attendance/report', [AttendanceController::class, 'report']);
// Route::get('/attendance/report-form', [AttendanceController::class, 'reportForm']);

// View attendance form (select class and date)
Route::get('/attendance/view', [AttendanceController::class, 'viewForm'])->name('attendance.viewForm');

// Show attendance based on selected class & date
Route::post('/attendance/view', [AttendanceController::class, 'viewAttendance'])->name('attendance.view');


Route::get('attendance/edit/{id}', [AttendanceController::class, 'editAttendance'])->name('attendance.edit');
Route::put('attendance/update/{id}', [AttendanceController::class, 'updateAttendance'])->name('attendance.update');


// Result Routes

Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::post('/results/create', [ResultController::class, 'create'])->name('results.create');
Route::post('/results/store', [ResultController::class, 'store'])->name('results.store');


// Marksheets routes

// MARKSHEETS (ADMIN)
 Route::get('/marksheets', [MarksheetController::class, 'index'])->name('marksheets.index');
Route::get('/marksheets/class/{class}', [MarksheetController::class, 'classWise'])->name('marksheets.class');

// Backward compatible route (old)
Route::get('/marksheets/generate/{student}', [MarksheetController::class, 'generate'])->name('marksheets.generate.latest');

// Edit extra fields
Route::get('/marksheets/{student}/edit-extra/{class}', [MarksheetController::class, 'editExtra'])->name('marksheets.extra.edit');
Route::post('/marksheets/{student}/save-extra/{class}', [MarksheetController::class, 'saveExtra'])->name('marksheets.extra.save');

// Main generate route (use this in UI)
Route::get('/marksheets/{student}/generate/{class}', [MarksheetController::class, 'generatePdf'])->name('marksheets.generate');

Route::get('/marksheets/{student}/attendance-summary/{class}', [MarksheetController::class, 'attendanceSummary'])
    ->name('marksheets.attendanceSummary');


// Examination module
Route::get('/examinations', [ExaminationController::class, 'index'])->name('exams.index');

Route::get('/examinations/{type}', [ExaminationController::class, 'classes'])
    ->name('exams.classes');

Route::get('/examinations/{type}/class/{class}', [ExaminationController::class, 'students'])
    ->name('exams.students');

Route::get('/examinations/{type}/class/{class}/student/{student}', [ExaminationController::class, 'entry'])
    ->name('exams.entry');

// Optional: Subject template per class/exam
Route::get('/examinations/{type}/class/{class}/subjects', [ExaminationController::class, 'editSubjects'])
    ->name('exams.subjects.edit');

Route::post('/examinations/{type}/class/{class}/subjects', [ExaminationController::class, 'saveSubjects'])
    ->name('exams.subjects.save');


});

require __DIR__.'/auth.php';
