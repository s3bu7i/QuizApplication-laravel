<?php

// app/Http/Controllers/QuizController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required|integer',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')
                         ->with('success', 'Quiz created successfully.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required|integer',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')
                         ->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
                         ->with('success', 'Quiz deleted successfully.');
    }
}