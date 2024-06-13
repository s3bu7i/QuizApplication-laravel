<?php

// app/Http/Controllers/QuestionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class QuestionController extends Controller
{
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required',
            'type' => 'required|in:multiple_choice,true_false,short_answer',
        ]);

        $quiz->questions()->create($request->all());

        return redirect()->route('quizzes.show', $quiz->id)
                         ->with('success', 'Question added successfully.');
    }
}