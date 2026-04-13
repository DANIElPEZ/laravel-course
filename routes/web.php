<?php

// in routes define the routes of the application and define the requests methods
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AnswerController, PageController, QuestionController};

// in this route, the controller use the clas and execute index method in controller, and the name represent the name of the route
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('question.show');
Route::delete('question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
