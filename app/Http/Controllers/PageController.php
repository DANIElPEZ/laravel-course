<?php

namespace App\Http\Controllers;

use App\Models\Question;

class PageController extends Controller
{
    // the controller manage the logic of the application, and return the data for example to the view
    public function index()
    {
        $question=Question::with('category', 'user')->latest()->get();
        return view('pages.home',[
            'questions'=>$question
        ]);
    }
}
