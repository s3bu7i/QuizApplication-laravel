<?php

// routes/web.php
use Illuminate\Support\Facades\Route; // Add this line

use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ResultController; // Add this line

Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/create', [QuizController::class, 'create'])->middleware('auth', 'admin');
Route::post('/quizzes', [QuizController::class, 'store'])->middleware('auth', 'admin');
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->middleware('auth', 'admin');
Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->middleware('auth', 'admin');
Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->middleware('auth', 'admin');

Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->middleware('auth', 'admin');
Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->middleware('auth', 'admin');