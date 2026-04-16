<?php

namespace App\Support;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionShowLoader
{
    public function load(Question $question)
    {
        return $question->load($this->getRelations());
    }

    public function getRelations()
    {
         $userId = Auth::id();
     return [
        //optimize query, from question model load methods
            'user',
            'category',
            'answers' => fn($query) => $query->with([
                'user',
                'hearts' => fn($query) => $query->where('user_id', $userId),
                'comments' => fn($query) => $query->with([
                    'user',
                    'hearts' => fn($query) => $query->where('user_id', $userId),
                ]),
            ]),

            'comments' => fn($query) => $query->with([
                'user',
                'hearts' => fn($query) => $query->where('user_id', $userId),
            ]),
            'hearts' => fn($query) => $query->where('user_id', $userId),
     ];
    }
}