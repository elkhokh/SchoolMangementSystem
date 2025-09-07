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

Route::get('/', function () {
    return redirect()->route('login');

});

/************************************* route of pages ******************************************************* */
Route::middleware('auth:web')->prefix('admin')->group(function(){

Route::get('users/student', [UserController::class, 'getStudent'])->name('users.student');
Route::get('users/teacher', [UserController::class, 'getTeacher'])->name('users.teacher');
Route::post('subjects/delete_all', [SubjectsController::class, 'delete_all'])->name('subjects.delete_all');
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
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/******************  Roles & Users (Auth Protected) *******************************************************/


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

});
/**************************************************************************************************************/
// });
/********************************* Authentication Routes *************************************************** */
require __DIR__.'/auth.php';
require __DIR__.'/student.php';
require __DIR__.'/teacher.php';


// Route::middleware(['auth' , 'checkStatus'])->group(function(){
/************************************************************************************************************* */
