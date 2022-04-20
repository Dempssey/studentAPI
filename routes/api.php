<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ProjectController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("register","Api\StudentController@register");
Route::post("login","Api\StudentController@login");


Route::middleware('auth:sanctum')->group(function () {
    Route::get("profile","Api\StudentController@profile");
    Route::get("logout","Api\StudentController@logout");

    Route::post("create","Api\ProjectController@createProject");
    Route::get("projects","Api\ProjectController@listProjects");
    Route::get("project/{id}","Api\ProjectController@singleProject");
    Route::delete("project/{id}","Api\ProjectController@deleteProject");

});
