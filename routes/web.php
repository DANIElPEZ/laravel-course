<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AnswerController, PageController, QuestionController};

// in this route, the controller use the class and execute index method in controller, and the name represent the name of the route
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');

Route::middleware(['auth'])->group(function () {
    Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
    
    Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update')->can('update', 'question');
    Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy')->can('delete', 'question');
    
    Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
});
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
