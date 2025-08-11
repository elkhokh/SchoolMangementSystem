<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeacherController;
// use App\Http\Controllers\UserController;

/********************************* Authentication Routes *************************************************** */
require __DIR__.'/auth.php';

// Route::middleware(['auth' , 'checkStatus'])->group(function(){

Route::get('/', function () {
    return view('auth.login');
});

/************************************* route of pages ******************************************************* */

// Route::resource('classses',ClassesController::class);
Route::resources([
    'classes'    => ClassesController::class,
    'teachers'   => TeacherController::class,
    'students'   => StudentsController::class,
    'subjects'   => SubjectsController::class,
    'sessions'   => ClassSessionController::class,
]);

/****************************************Dashboard******************************************************** */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/******************  Roles & Users (Auth Protected) *******************************************************/

// Route::group(['middleware' => ['auth']], function() {
//     // Route::resources([
//     //     'roles' => RoleController::class,
//     //     'users' => UserController::class,
//     // ]);
// Route::resource('roles', RoleController::class);
// Route::resource('users', UserController::class);
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


