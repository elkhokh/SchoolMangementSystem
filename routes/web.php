<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;


Route::get('test', [TestController::class, 'checkout'])->name('test');
Route::get('/', function () {
    return view('auth.login');
});
/*************** livewire test ***************************************************************************** */
// Route::get('/counter',function(){
// return view('test');
// });
/************************************* route of pages ******************************************************* */
Route::get('users/student', [UserController::class, 'getStudent'])->name('users.student');
Route::get('users/teacher', [UserController::class, 'getTeacher'])->name('users.teacher');
// Route::post('users/add_student', [UserController::class, 'storeStudent'])->name('users.add_student');
Route::post('subjects/delete_all', [SubjectsController::class, 'delete_all'])->name('subjects.delete_all');
// Route::post('users/add_teacher', [UserController::class, 'addTeacher'])->name('users.add_teacher');
Route::post('attendances/class', [ClassesController::class, 'classes'])->name('attendances.class');

Route::get('/callback',[PaymentController::class,'callback'])->name('callback');

// Route::resource('classses',ClassesController::class);
Route::resources([
    'classes'    => ClassesController::class,
    'teachers'   => TeacherController::class,
    'students'   => StudentsController::class,
    'subjects'   => SubjectsController::class,
    'attandances'   => AttendancesController::class,
    'sessions'   => ClassSessionController::class,
    'exams'   => ExamController::class,
    'student_exams'   => StudentExamController::class,
    'payments' => PaymentController::class,
]);

/****************************************Dashboard******************************************************** */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/******************  Roles & Users (Auth Protected) *******************************************************/

// Route::group(['middleware' => ['auth']], function() {
    // Route::resources([
    //     'roles' => RoleController::class,
    //     'users' => UserController::class,
    // ]);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
// });

/*********************************Profile (Auth Protected)************************************************** */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware('auth');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

/***************************************call pages using var with url******************************************/

Route::get('/{page}', [AdminController::class, 'index']);

/**************************************************************************************************************/
// });
/********************************* Authentication Routes *************************************************** */
require __DIR__.'/auth.php';

// Route::middleware(['auth' , 'checkStatus'])->group(function(){
/************************************************************************************************************* */
