<!-- resources/views/quizzes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quizzes</h1>
    @foreach ($quizzes as $quiz)
    <div>
        <h2>{{ $quiz->title }}</h2>
        <p>{{ $quiz->description }}</p>
        <p>Duration: {{ $quiz->duration }} minutes</p>
        <a href="{{ route('quizzes.show', $quiz->id) }}">View Details</a>
    </div>
    @endforeach
</div>
@endsection