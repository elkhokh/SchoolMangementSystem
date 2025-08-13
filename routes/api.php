<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\SubjectsController;
use App\Http\Controllers\Api\ClassSessionController;


Route::apiResources([
    'classes'    => ClassesController::class,
    'teachers'   => TeacherController::class,
    'students'   => StudentsController::class,
    'subjects'   => SubjectsController::class,
    'sessions'   => ClassSessionController::class,
]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/*
// Route::apiResource('classes',ClassesController::class);
// Route::apiResource('teachers', TeacherController::class);
// Route::apiResource('students', StudentsController::class);
// Route::apiResource('subjects', SubjectsController::class);
// Route::apiResource('sessions', ClassSessionController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("login", [AuthController::class, "login"])->middleware('throttle:5,1');// limit of login
// اقدر كمان اعملها ع الميدل وير مش اللوجين بس
Route::middleware("auth:sanctum")->group(function () {
    Route::post("logout", [AuthController::class, "logout"]);
    Route::post("updata_profile", [AuthController::class, "updata_profile"]);
    Route::apiResource("posts", PostController::class);
});


/api/classes      = get    => index
/api/classes      = post   => store
/api/classes/{id} = get    => show
/api/classes/{id} = put    => update
/api/classes/{id} = delete => destroy

*/


