<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CoverPhotoController;
use App\Http\Controllers\ExternalLinkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TechnologyController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('about',AboutController::class)
        ->only(['index','create','store','edit','update'])
        ->middleware(['auth', 'verified']);

Route::resource('coverphoto',CoverPhotoController::class)
        ->only(['index','store','edit','update','destroy'])
        ->middleware(['auth','verified']);

Route::resource('project',ProjectController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware(['auth', 'verified']);

Route::resource('skill', SkillController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware(['auth', 'verified']);

Route::resource('externallink',ExternalLinkController::class)
        ->only(['index','store','edit','update','destroy'])
        ->middleware(['auth','verified']);

Route::resource('socialmedia',SocialMediaController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware(['auth', 'verified']);

Route::resource('technology', TechnologyController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
