<?php

// app/Http/Controllers/AnswerController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'answer_text' => 'required',
            'is_correct' => 'required|boolean',
        ]);

        $question->answers()->create($request->all());

        return redirect()->route('quizzes.show', $question->quiz->id)
                         ->with('success', 'Answer added successfully.');
    }
}