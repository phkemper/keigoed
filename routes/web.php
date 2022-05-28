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
Route::post('/quizzes/{id}', [App\Http\Controllers\QuizController::class, 'update'])->middleware(['auth'])->name('quizzes.update');
Route::get('/quizzes/{id}/delete', [App\Http\Controllers\QuizController::class, 'delete'])->middleware(['auth'])->name('quizzes.delete');
Route::post('/quizzes/{id}/delete', [App\Http\Controllers\QuizController::class, 'destroy'])->middleware(['auth'])->name('quizzes.destroy');
Route::get('/quizzes/{id}/run', [App\Http\Controllers\QuizController::class, 'run'])->middleware(['auth'])->name('quizzes.run');
Route::get('/quizzes/{id}/stop', [App\Http\Controllers\QuizController::class, 'stop'])->middleware(['auth'])->name('quizzes.stop');

Route::get('/quizzes/{id}/questions', [App\Http\Controllers\QuestionController::class, 'index'])->middleware(['auth'])->name('questions.index');
Route::get('/quizzes/{id}/questions/create', [App\Http\Controllers\QuestionController::class, 'create'])->middleware(['auth'])->name('questions.create');
Route::post('/quizzes/{id}/questions', [App\Http\Controllers\QuestionController::class, 'store'])->middleware(['auth'])->name('questions.store');
Route::get('/quizzes/{id}/questions/{qid}', [App\Http\Controllers\QuestionController::class, 'show'])->middleware(['auth'])->name('questions.show');
Route::post('/quizzes/{id}/questions/{qid}', [App\Http\Controllers\QuestionController::class, 'update'])->middleware(['auth'])->name('questions.update');
Route::get('/quizzes/{id}/questions/{qid}/delete', [App\Http\Controllers\QuestionController::class, 'delete'])->middleware(['auth'])->name('questions.delete');
Route::post('/quizzes/{id}/questions/{qid}/delete', [App\Http\Controllers\QuestionController::class, 'destroy'])->middleware(['auth'])->name('questions.destroy');
Route::get('/quizzes/{id}/questions/{qid}/up', [App\Http\Controllers\QuestionController::class, 'up'])->middleware(['auth'])->name('questions.up');
Route::get('/quizzes/{id}/questions/{qid}/down', [App\Http\Controllers\QuestionController::class, 'down'])->middleware(['auth'])->name('questions.down');

require __DIR__.'/auth.php';
