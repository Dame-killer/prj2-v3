<?php

use App\Http\Controllers\AA\AAController;
use App\Http\Controllers\AA\AaStudentController;
use App\Http\Controllers\AA\ClassController;
use App\Http\Controllers\AA\MajorController;
use App\Http\Controllers\AA\PointController;
use App\Http\Controllers\AA\SubjectBKController;
use App\Http\Controllers\AA\SubjectBTECController;
use App\Http\Controllers\AA\ClassSubjectController;
use App\Http\Controllers\AA\CSSController;
use App\Http\Controllers\Student\StudentController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/student/home', [StudentController::class, 'home'])->name('student-home');

Route::get('/academic_affairs/home', [AAController::class, 'home'])->name('aa-home');



Route::get('/academic_affairs/majors', [MajorController::class, 'index'])->name('aa-major');

Route::post('/academic_affairs/majors', [MajorController::class, 'createMajor'])->name('aa-major-create');

Route::post('/academic_affairs/majors/delete', [MajorController::class, 'deleteMajorById'])->name('aa-major-delete');

Route::post('/academic_affairs/majors/update', [MajorController::class, 'updateMajorById'])->name('aa-major-update');

Route::get('/academic_affairs/majors/edit', [MajorController::class, 'edit'])->name('aa-major-edit');



Route::get('/academic_affairs/classes', [ClassController::class, 'index'])->name('aa-class');

Route::post('/academic_affairs/classes/create', [ClassController::class, 'createClass'])->name('aa-class-create');

Route::post('/academic_affairs/classes/delete', [ClassController::class, 'deleteClassById'])->name('aa-class-delete');

Route::post('/academic_affairs/classes/update', [ClassController::class, 'updateClassById'])->name('aa-class-update');

Route::get('/academic_affairs/classes/edit', [ClassController::class, 'edit'])->name('aa-class-edit');



Route::get('/academic_affairs/students', [AaStudentController::class, 'index'])->name('aa-student');

Route::post('/academic_affairs/students',[AaStudentController::class, 'createStudent'])->name('aa-student-create');

Route::post('/academic_affairs/student/delete', [AaStudentController::class, 'deleteStudentById'])->name('aa-student-delete');

Route::post('/academic_affairs/students/update', [AaStudentController::class, 'updateStudentById'])->name('aa-student-update');

Route::get('/academic_affairs/students/edit', [AaStudentController::class, 'edit'])->name('aa-student-edit');



Route::get('/academic_affairs/subjects/BK', [SubjectBKController::class, 'indexBK'])->name('aa-subject-BK');

Route::post('/academic_affairs/subjects/BK', [SubjectBKController::class, 'createBK'])->name('aa-subject-createBK');

Route::post('/academic_affairs/subjects/BK/delete', [SubjectBKController::class, 'deleteBKById'])->name('aa-subject-deleteBK');

Route::post('/academic_affairs/subjects/BK/update', [SubjectBKController::class, 'updateBKById'])->name('aa-subject-updateBK');

Route::get('/academic_affairs/subjects/BK/edit', [SubjectBKController::class, 'editBK'])->name('aa-subject-editBK');



Route::get('/academic_affairs/subjects/BTEC', [SubjectBTECController::class, 'indexBTEC'])->name('aa-subject-BTEC');

Route::post('/academic_affairs/subjects/BTEC', [SubjectBTECController::class, 'createBTEC'])->name('aa-subject-createBTEC');

Route::post('/academic_affairs/subjects/BTEC/delete', [SubjectBTECController::class, 'deleteBTECById'])->name('aa-subject-deleteBTEC');

Route::post('/academic_affairs/subjects/BTEC/update', [SubjectBTECController::class, 'updateBTECById'])->name('aa-subject-updateBTEC');

Route::get('/academic_affairs/subjects/BTEC/edit', [SubjectBTECController::class, 'editBTEC'])->name('aa-subject-editBTEC');



Route::get('/academic_affairs/points/class', [PointController::class, 'indexClass'])->name('aa-point-class');

Route::get('/academic_affairs/points/subject', [PointController::class, 'indexSubject'])->name('aa-point-subject');

Route::get('/academic_affairs/points/point', [PointController::class, 'indexPoint'])->name('aa-point-point');

Route::get('/academic_affairs/points/edit', [PointController::class, 'edit'])->name('aa-point-edit');

Route::post('/academic_affairs/points/insert', [PointController::class, 'insert'])->name('aa-point-insert');

Route::post('/save-point-data', [PointController::class, 'saveData']);



Route::get('/academic_affairs/students/point',[AaStudentController::class, 'showPoint'])->name('aa-student-point');



Route::get('/academic_affairs/classes-subjects/index', [ClassSubjectController::class,'index'])->name('aa-classes-subjects');

Route::post('/academic_affairs/classes-subjects/index', [ClassSubjectController::class,'createClassSubject'])->name('aa-classes-subjects-create');

Route::post('/academic_affairs/classes-subjects/delete', [ClassSubjectController::class,'deleteClassSubjectById'])->name('aa-classes-subjects-del');

Route::post('/academic_affairs/classes-subjects/update', [ClassSubjectController::class,'updateClassSubjectById'])->name('aa-classes-subjects-update');

Route::get('/academic_affairs/classes-subjects/edit', [ClassSubjectController::class,'edit'])->name('aa-classes-subjects-edit');



// Route::get('/academic_affairs/classes-subjects/index', [CSSController::class,'index'])->name('aa-css');

// Route::post('/academic_affairs/class-subject-students/index', [CSSController::class,'createCSS'])->name('aa-css-create');

// Route::post('/academic_affairs/class-subject-students/delete', [CSSController::class,'deleteCSSById'])->name('aa-css-del');

// Route::post('/academic_affairs/class-subject-students/update', [CSSController::class,'updateCSSById'])->name('aa-css-update');

// Route::get('/academic_affairs/class-subject-students/edit', [CSSController::class,'edit'])->name('aa-css-edit');
