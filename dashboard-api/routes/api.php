<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\CoverphotoController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('about/{email}', [AboutController::class, 'about'])->name('about');
Route::get('coverphoto/{email}', [CoverphotoController::class, 'coverphoto'])->name('coverphoto');
Route::get('skill/{email}',[SkillController::class, 'skill'])->name('skill');
Route::get('project/{email}',[ProjectController::class, 'project'])->name('project');
Route::get('project/{email}/{id}',[ProjectController::class, 'projectById'])->name('project');
Route::post('email',[EmailController::class, 'send'])->name('email');

