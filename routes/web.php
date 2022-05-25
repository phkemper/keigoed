<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

App::setLocale('nl');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\HomeController::class, 'join']);

Route::get('/quizzes', [App\Http\Controllers\QuizController::class, 'index'])->middleware(['auth'])->name('quizzes.index');
Route::get('/quizzes/create', [App\Http\Controllers\QuizController::class, 'create'])->middleware(['auth'])->name('quizzes.create');
Route::post('/quizzes', [App\Http\Controllers\QuizController::class, 'store'])->middleware(['auth'])->name('quizzes.store');
Route::get('/quizzes/{id}', [App\Http\Controllers\QuizController::class, 'show'])->middleware(['auth'])->name('quizzes.show');
Route::get('/quizzes/{id}/edit', [App\Http\Controllers\QuizController::class, 'edit'])->middleware(['auth'])->name('quizzes.edit');
Route::put('/quizzes/{id}', [App\Http\Controllers\QuizController::class, 'update'])->middleware(['auth'])->name('quizzes.update');
Route::delete('/quizzes/{id}', [App\Http\Controllers\QuizController::class, 'destroy'])->middleware(['auth'])->name('quizzes.destroy');
Route::post('/quizzes/{id}', [App\Http\Controllers\QuizController::class, 'run'])->middleware(['auth'])->name('quizzes.run');

require __DIR__.'/auth.php';
