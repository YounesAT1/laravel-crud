<?php

use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

//? PROJECT ROUTES
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('/projects/{project}/details', [ProjectController::class, 'details'])->name('projects.details');
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

//? DEVELOPER ROUTES
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.index');
Route::get('/developers/create', [DeveloperController::class, 'create'])->name('developers.create');
Route::get('/developers/{developer}/edit', [DeveloperController::class, 'edit'])->name('developers.edit');
Route::get('/developers/{developer}/details', [DeveloperController::class, 'details'])->name('developers.details');
Route::get('/developers/search', [DeveloperController::class, 'search'])->name('developers.search');
Route::post('/developers', [DeveloperController::class, 'store'])->name('developers.store');
Route::put('/developers/{developer}', [DeveloperController::class, 'update'])->name('developers.update');
Route::delete('/developer/{developer}', [DeveloperController::class, 'destroy'])->name('developers.destroy');

//? TASK ROUTES
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/{task}/details', [TaskController::class, 'details'])->name('tasks.details');
Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');













Route::get('/', function () {
    return view('welcome');
});
