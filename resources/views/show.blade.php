<!-- resources/views/quizzes/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>
    <p>Duration: {{ $quiz->duration }} minutes</p>

    @if (auth()->check() && auth()->user()->is_admin)
    <form action="{{ route('quizzes.questions.store', $quiz->id) }}" method="POST">
        @csrf
        <div>
            <label for="question_text">Question Text</label>
            <input type="text" name="question_text" id="question_text" required>
        </div>
        <div>
            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="true_false">True/False</option>
                <option value="short_answer">Short Answer</option>
            </select>
        </div>
        <button type="submit">Add Question</button>
    </form>
    @endif

    <h2>Questions</h2>
    @foreach ($quiz->questions as $question)
    <div>
        <h3>{{ $question->question_text }}</h3>
        <p>Type: {{ $question->type }}</p>

        @if (auth()->check() && auth()->user()->is_admin)
        <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
            @csrf
            <div>
                <label for="answer_text">Answer Text</label>
                <input type="text" name="answer_text" id="answer_text" required>
            </div>
            <div>
                <label for="is_correct">Is Correct</label>
                <input type="checkbox" name="is_correct" id="is_correct">
            </div>
            <button type="submit">Add Answer</button>
        </form>
        @endif

        <h4>Answers</h4>
        @foreach ($question->answers as $answer)
        <p>{{ $answer->answer_text }} ({{ $answer->is_correct ? 'Correct' : 'Incorrect' }})</p>
        @endforeach
    </div>
    @endforeach

    @if (auth()->check())
    <form action="{{ route('quizzes.results.store', $quiz->id) }}" method="POST">
        @csrf
        <div>
            <label for="score">Score</label>
            <input type="number" name="score" id="score" required>
        </div>
        <button type="submit">Submit Score</button>
    </form>
    @endif
</div>
@endsection