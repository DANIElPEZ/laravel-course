<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Question $question){
        $question->load('user', 'category','answers');
        return view('questions.show', [
            'question' => $question,
        ]);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home');
    }
}
