<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\SubjectsController;
use App\Http\Controllers\Api\ClassSessionController;

//info::  /api/classes      = get         => index    ==>>  just explin
//info::  /api/classes      = post        => store    ==>>  just explin
//info::  /api/classes/{id} = get         => show     ==>>  just explin
//info::  /api/classes/{id} = put/patch   => update   ==>>  just explin
//info::  /api/classes/{id} = delete      => destroy  ==>>  just explin

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]) ->middleware('throttle:5,1');// limit of login 5 times in one minute

Route::middleware("auth:sanctum")->group(function () {

    Route::put("updata_profile", [AuthController::class, "updata_profile"]);
    Route::post("logout", [AuthController::class, "logout"]);

    Route::apiResources([
    'classes'    => ClassesController::class,
    'subjects'   => SubjectsController::class,
    'teachers'   => TeacherController::class,
    'students'   => StudentsController::class,
    'sessions'   => ClassSessionController::class,
]);

});














/*
// Route::apiResource('classes',ClassesController::class);
// Route::apiResource('teachers', TeacherController::class);
// Route::apiResource('students', StudentsController::class);
// Route::apiResource('subjects', SubjectsController::class);
// Route::apiResource('sessions', ClassSessionController::class);

*/


