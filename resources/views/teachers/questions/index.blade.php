@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Manage Exam-Questions </h1>

        <div class="text-right">
            <a href="{{ route('exams.index') }}" class="btn btn-primary">Exam List</a>
            <a href="{{ route('exams.questions.create', $exam->id) }}" class="btn btn-primary">Add Question</a>
        </div>

        <div class="col-md-12 ">
            <h5>Exam Details</h5>
            <div class="d-flex">
                <div class="col-md-3 d-flex">
                    <label for="form_name">Name : </label>
                    <h5 class="ml-2"> {{ $exam->name }}</h5>
                </div>
                <div class="col-md-3  d-flex"> <label for="form_name">Duration : </label>
                    <h5 class="ml-2"> {{ $exam->duration }}</h5>
                </div>
                <div class="col-md-3  d-flex"> <label for="form_name">Total mark : </label>
                    <h5 class="ml-2"> {{ $exam->total_mark }}</h5>
                </div>
                <div class="col-md-3  d-flex"> <label for="form_name">Pass mark : </label>
                    <h5 class="ml-2"> {{ $exam->pass_mark }}</h5>
                </div>



            </div>
        </div>
        <div class="d-flex">
            <div class="col-md-3  d-flex"> <label for="form_name">Total Questions : </label>
                <h5 class="ml-2"> {{ $exam->questions->count('id') }}</h5>
            </div>
            <div class="col-md-3  d-flex"> <label for="form_name">Total Mark : </label>
                <h5 class="ml-2"> {{ $exam->questions->sum('mark') }}</h5>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Question</th>
                    @for ($i = 1; $i <= 4; $i++)
                        <th>Choice{{ $i }}</th>
                    @endfor
                    <th>Correct Answer</th>
                    <th>Mark</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exam->questions as $question)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td>{{ $question->choice1 }}</td>
                        <td>{{ $question->choice2 }}</td>
                        <td>{{ $question->choice3 }}</td>
                        <td>{{ $question->choice4 }}</td>
                        <td>{{ $question->correct_choice }}</td>
                        <td>{{ $question->mark }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('exams.questions.edit', ['exam' => $exam->id, 'question' => $question->id]) }}"
                                    class="btn btn-warning ml-2">Edit</a>
                                <form
                                    action="{{ route('exams.questions.destroy', ['exam' => $exam->id, 'question' => $question->id]) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-2"
                                        onclick="return confirm('Are you sure you want to delete this exam?')">
                                        Delete
                                    </button>

                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
