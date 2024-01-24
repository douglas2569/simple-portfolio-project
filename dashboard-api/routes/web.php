<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CoverPhotoController;
use App\Http\Controllers\ExternalLinkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Middleware\CheckingAboutExists;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TechnologyController;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('about',[AboutController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('about');

Route::get('socialmedia',[SocialMediaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->middleware(CheckingAboutExists::class)
    ->name('socialmedia');

Route::get('coverphoto',[CoverPhotoController::class, 'index'])
    ->middleware(['auth','verified'])
    ->middleware(CheckingAboutExists::class)
    ->name('coverphoto');


Route::get('skill',[SkillController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('skill');

Route::get('technology',[TechnologyController::class, 'index'])
    ->middleware('auth','verified')
    ->name('technology');

Route::get('project',[ProjectController::class, 'index'])
    ->middleware('auth','verified')
    ->name('project');

Route::get('externallink',[ExternalLinkController::class, 'index'])
    ->middleware('auth','verified')
    ->name('externallink');

require __DIR__.'/auth.php';
